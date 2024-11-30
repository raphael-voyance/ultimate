<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;
use App\Models\TimeSlot;
use App\Concern\Numerology;
use App\Models\Appointment;
use App\Models\TimeSlotDay;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rules\Password;
use App\Concern\Invoice as ConcernInvoice;
use App\Concern\StatusAppointmentNotifications as ConcernNotifications;
use App\Concern\Tarot;

class AppointmentModal extends Component
{
    public bool $hasError = false;
    public string $errorMessage = "";
    public bool $appointmentModal = false;
    public array $appointment = [];
    public string|null $appointmentType = null;
    public int $totalStep = 4;
    public int $activeStep = 1;
    public $timeSlotDays;
    public int|null $timeSlotDayId = null;
    public int|null $timeSlotId = null;
    public string|null $timeSlotForHuman = null;
    public string|null $timeSlotDayForHuman = null;
    public int $offsetTimeSlot = 0;
    public $hasMoreTimeSlots;
    public array $writingConsultation = [];
    public string|null $writingConsultationQuestion = null;
    public string $currentValidationForm = 'formQuestion';

    //Login && Registration User Datas
    public $userProfile = null;
    public $birthday;
    public $time_of_birth;
    public $native_country;
    public $city_of_birth;
    public $email;
    public $password;
    public $remember;
    public $first_name;
    public $last_name;
    public $password_confirmation;

    // Services / Payment
    public $services;
    //A faire : reccupérer les montant depuis la bdd
    public $amounts;
    public string $priceForHuman;

    // Validation Forms
    // Rules
    protected function rules()
    {
        if ($this->currentValidationForm === 'formQuestion') {
            return [
                'writingConsultationQuestion' => ['required', 'min:50'],
            ];
        } else if($this->currentValidationForm === 'formBirthDate') {
            return [
                'birthday' => ['required', 'date']
            ];
        } else if($this->currentValidationForm === 'formInformationOfBirth') {
            return [
                'time_of_birth' => ['required'],
                'city_of_birth' => ['string', 'required'],
                'native_country' => ['string', 'required'],
            ];
        } else {
            return [];
        }
    }
    // Messages
    protected function messages()
    {
        if ($this->currentValidationForm === 'formQuestion') {
            return [
                'writingConsultationQuestion.required' => 'Votre question est requise pour continuer.',
                'writingConsultationQuestion.min' => 'Votre question doit comporter au moins :min caractères.',
            ];
        } else if($this->currentValidationForm === 'formBirthDate') {
            return [
                'birthday.required' => 'Merci de saisir votre date de naissance.',
                'birthday.date' => 'Votre date de naissance doit être au format valide.',
            ];
        } else if($this->currentValidationForm === 'formInformationOfBirth') {
            return [
                'time_of_birth.required' => 'Merci de saisir une heure de naissance valide.',
                'city_of_birth.string' => 'Merci de saisir une chaîne de caractères valides.',
                'city_of_birth.required' => 'Merci de saisir le nom d\'une ville.',
                'native_country.string' => 'Merci de saisir une chaîne de caractères valides.',
                'native_country.required' => 'Merci de saisir le nom d\'un pays.',
            ];
        } else {
            return [];
        }
    }

    // Mount
    public function mount()
    {
        // Visibility For Modal
        $appointmentModalIsVisible = session('appointmentModalShow');
        if ($appointmentModalIsVisible !== null) {
            $this->appointmentModal = $appointmentModalIsVisible;
        }

        // Hydrate $this->appointment = [] if Appointment exist in UserSession;
        if (session()->has('appointment_form')) {
            $this->appointment = session('appointment_form');
            $this->appointmentType = session('appointment_form.type');
            $this->activeStep = session('appointment_form.active_step') ? session('appointment_form.active_step') : 1;
            $this->writingConsultation = session('appointment_form.writing_consultation') ? session('appointment_form.writing_consultation') : [];
            $this->writingConsultationQuestion = isset(session('appointment_form.writing_consultation')['question']) ? session('appointment_form.writing_consultation')['question'] : null;
            $this->timeSlotDayId = session('appointment_form.time_slot_day');
            $this->timeSlotId = session('appointment_form.time_slot');
            $this->timeSlotForHuman = session('appointment_form.time_slot_for_human');
            $this->timeSlotDayForHuman = session('appointment_form.time_slot_day_for_human');
        }else {
            $this->appointment['time_slot_day'] = null;
            $this->appointment['type'] = null;
        }

        // Get all services
        $this->services = Product::where('type', 'SERVICE_PRODUCT')
            ->where('available', true)
            ->get();

        // Get Amounts Services from bdd
        foreach($this->services as $p) {
            $this->amounts[$p->slug] = $p->price;
        }

        if($this->appointmentType != null) {
            $this->priceForHuman = $this->setAmountPriceForHuman($this->amounts[$this->appointment['type']]);
        }

        // Get User Informations if Exist
        if (Auth::user()) {
            $userProfileData = collect(Auth::user()->profile->toArray())
                ->only(['birthday', 'astrology'])
                ->toArray();

            // Décoder la chaîne JSON de la clé 'astrology'
            if($userProfileData['astrology']) {
            $astrologyData = json_decode($userProfileData['astrology']);
            } else {
                $astrologyData = [];
            }

            // Recréer un nouvel objet avec 'birthday' et 'astrology' comme propriétés
            $this->userProfile = (object)[
                'birthday' => $userProfileData['birthday'],
                'astrology' => $astrologyData,
            ];

            if($userProfileData['birthday']) {
                $this->birthday = $userProfileData['birthday'];
            }
            if(isset($astrologyData->time_of_birth)) {
                $this->time_of_birth = $astrologyData->time_of_birth;
            }
            if(isset($astrologyData->city_of_birth)) {
                $this->city_of_birth = $astrologyData->city_of_birth;
            }
            if(isset($astrologyData->native_country)) {
                $this->native_country = $astrologyData->native_country;
            }

        }

        // Initialize SlotDays
        $this->loadTimeSlotDays();
    }

    //Listener for event save-birthday
    #[On('save-birthday')]
    public function updateUserProfileData()
    {
        $userProfileData = collect(Auth::user()->profile->toArray())
                ->only(['birthday', 'astrology'])
                ->toArray();

            $this->userProfile = (object)$userProfileData;
            $this->userProfile;
    }

    // # PRIVATE METHODS #
    //Load All TimeSlotDays to Array
    // private function loadTimeSlotDays()
    // {
    //     $this->timeSlotDays = TimeSlotDay::with('time_slots')
    //         ->whereHas('time_slots', function(Builder $query) {
    //             return $query->where('available', true);
    //         })
    //         ->where('day', '>', Carbon::now()->startOfDay())
    //         ->orderBy('day')
    //         ->skip($this->offsetTimeSlot)
    //         ->limit(5)
    //         ->get()
    //         ->map(function ($timeSlotDay) {
    //             // Formater le timestamp 'day' pour chaque créneau horaire
    //             $timeSlotDay->dayFormatte = Carbon::parse($timeSlotDay->day)->translatedFormat('l j F Y');

    //             // creer une fonction qui retourne vrai ou faux en fonction de si un timeslotday possède au moins 1 timeslot actif

    //             return $timeSlotDay;
    //         })->toArray();

    //         // dd($this->timeSlotDays);
    // }
    private function loadTimeSlotDays()
    {
        // Charger les créneaux horaires actuels
        $this->timeSlotDays = TimeSlotDay::with('time_slots')
            ->whereHas('time_slots', function (Builder $query) {
                return $query->where('available', true);
            })
            ->where('day', '>', Carbon::now()->startOfDay())
            ->orderBy('day')
            ->skip($this->offsetTimeSlot)
            ->limit(5)
            ->get()
            ->map(function ($timeSlotDay) {
                // Formater le timestamp 'day' pour chaque créneau horaire
                $timeSlotDay->dayFormatte = Carbon::parse($timeSlotDay->day)->translatedFormat('l j F Y');
                return $timeSlotDay;
            })->toArray();

        // Vérifier s'il y a des créneaux horaires supplémentaires
        $nextSlots = TimeSlotDay::whereHas('time_slots', function (Builder $query) {
                return $query->where('available', true);
            })
            ->where('day', '>', Carbon::now()->startOfDay())
            ->orderBy('day')
            ->skip($this->offsetTimeSlot + 5)
            ->limit(5)
            ->get()
            ->count();

        // Si $nextSlots est à 0, cela signifie qu'il n'y a plus de créneaux horaires disponibles
        $this->hasMoreTimeSlots = $nextSlots > 0;
    }



    // Save Question For writing Consultation
    private function savewritingConsultationQuestion(): void
    {
        $this->currentValidationForm = 'formQuestion';

        $validatedData = $this->validate($this->rules(), $this->messages());

        $this->writingConsultationQuestion = $validatedData['writingConsultationQuestion'];
        $this->writingConsultation["question"] = $this->writingConsultationQuestion;
        $this->appointment["writing_consultation"] = $this->writingConsultation;

        $this->saveAppointmentInSession();
    }

    //Save Appointment in user session
    private function saveAppointmentInSession()
    {
        session(['appointment_form' => $this->appointment]);
    }
    //Delete Appointment in user session
    private function deleteAppointmentInSession()
    {
        session()->forget('appointment_form');
    }

    // # PUBLICS METHODS #
    //Open AppointmentModal
    public function openModal() :void
    {
        $this->appointmentModal = true;

        session(['appointmentModalShow' => $this->appointmentModal]);
    }

    //Close AppointmentModal
    public function closeModal() :void
    {
        $this->appointmentModal = false;
        session(['appointmentModalShow' => $this->appointmentModal]);
    }

    //Cancel AppointmentModal && Reinitializing datas
    public function resetModal() :void
    {
        $this->appointment = [
            "type" => null,
            "time_slot_day" => null,
            "time_slot" => null,
            "time_slot_day_for_human" => null,
            "time_slot_for_human" => null,
            "writing_consultation" => [],
            "active_step" => 1
        ];
        $this->activeStep = 1;
        $this->timeSlotDayId = null;
        $this->timeSlotId = null;
        $this->timeSlotForHuman = null;
        $this->timeSlotDayForHuman = null;
        $this->offsetTimeSlot = 0;
        $this->appointmentType = null;
        $this->writingConsultationQuestion = null;
        $this->closeModal();
        $this->deleteAppointmentInSession();
    }

    // //Login User
    // public function userLogin()
    // {

    //     $credentials = $this->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     if (Auth::attempt($credentials, $this->remember)) {
    //         session()->regenerate();
    //         $this->saveAppointmentInSession();
    //         return redirect('/');
    //     }

    //     //dd(session('status'));
    //     session()->flash('error', 'Vos informations de connexion ne correspondent pas. Merci de réessayer.');
    //     return back()->onlyInput('email');
    // }

    // //Register User
    // public function registerUser()
    // {
    //     $validatedData = $this->validate([
    //         'first_name' => ['required', 'string', 'max:255'],
    //         'last_name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
    //         'password' => [
    //             'required', Password::min(8)
    //                 ->letters()
    //                 ->mixedCase()
    //                 ->numbers()
    //                 ->symbols()
    //                 ->uncompromised(3)
    //         ],
    //         'password_confirmation' => 'same:password',
    //     ]);

    //     $user = User::create([
    //         'first_name' => $validatedData['first_name'],
    //         'last_name' => $validatedData['last_name'],
    //         'email' => $validatedData['email'],
    //         'password' => Hash::make($validatedData['password'],),
    //     ]);

    //     $avatar = "https://via.placeholder.com/480x480.png/00bb99";
    //     $user->roles()->attach(2);
    //     $user->profile()->create([
    //         'avatar' => $avatar
    //     ]);

    //     event(new Registered($user));

    //     Auth::login($user);

    //     return redirect(RouteServiceProvider::HOME);
    // }

    // Steps && Appointment

    //Navigate Steps -NEXT-
    public function nextStep(?int $step = null)
    {
        if ($this->activeStep === 3 && $this->appointmentType == 'writing') {
            $this->savewritingConsultationQuestion();
        }

        // A la dernière step
        if($step === $this->totalStep) {
            //1 - Créer un token unique Invoice
            $user_id = Auth::user()->id;
            $create_invoice = new ConcernInvoice($user_id);
            $invoice_token = $create_invoice->get_token();

            //2 - Créer une invoice en bdd avec les valeurs : 
            //== total_price payment_invoice_token appointment_id ref user_id

            $appointmentInformations = [
                "type" => $this->appointmentType,
                "time_slot_day" => $this->timeSlotDayId,
                "time_slot" => $this->timeSlotId,
                "time_slot_day_for_human" => $this->timeSlotDayForHuman,
                "time_slot_for_human" => $this->timeSlotForHuman,
                "writing_consultation"  => $this->writingConsultation,
            ];

            $invoice = Invoice::create([
                'total_price' => $this->amounts[$this->appointmentType],
                'payment_invoice_token' => $invoice_token,
                'invoice_informations' => json_encode($appointmentInformations),
                'user_id' => $user_id,
                'ref' => $create_invoice->get_ref(),
            ]);

            $invoice->products()->attach(Product::where('slug', $this->appointmentType)->first()->id);
            //== lier à un product == attach(product_id)

            //dd($invoice);

            $appointment = Appointment::create([
                'user_id' => $user_id,
                'time_slot_day_id' => $this->timeSlotDayId, 
                'time_slot_id' => $this->timeSlotId,
                'invoice_id' => $invoice->id,
                
                'appointment_message' => $this->writingConsultationQuestion ? $this->writingConsultationQuestion : null,

                'appointment_type' => $this->appointmentType,
            ]);

            // Mettre à jour l'invoice avec l'appointment_id
            $invoice->appointment_id = $appointment->id;
            $invoice->save();


            if($this->appointmentType != 'writing' && $appointment) {
                $timeSlot = TimeSlot::where('id', $this->timeSlotId)
                ->with(['time_slot_days' => function ($query) {
                    $query->where('time_slot_day_id', $this->timeSlotDayId);
                }])
                ->firstOrFail();

                $available = $timeSlot->time_slot_days->first()->pivot->available;

                if($available) {
                    $timeSlot->time_slot_days()->updateExistingPivot($this->timeSlotDayId, ['available' => false]);
                }else {
                    $this->activeStep = 3;
                    session(['appointment_form.active_step' => $this->activeStep]);
                    $this->dispatch('refreshPage');
                    return;
                }

                
            }

            //dd($invoice, $appointment);
            
            //3 - Rediriger l'utilisateur sur la page de paiement en passant le payment_invoice_token en paramètre d'url

            // in work
            if($invoice) {
                ConcernNotifications::sendNotification($invoice, 'CONFIRMED');
                
                ConcernNotifications::sendNotificationToAdmin($invoice, 'CONFIRMED');
                
                $this->resetModal();

                $this->redirectRoute('payment.create', [
                    'payment_invoice_token' => $invoice->payment_invoice_token
                ]);

                return;
            }
            
        }

        $this->activeStep++;

        $this->appointment = [
            "type" => $this->appointmentType,
            "time_slot_day" => $this->timeSlotDayId,
            "time_slot" => $this->timeSlotId,
            "time_slot_day_for_human" => $this->timeSlotDayForHuman,
            "time_slot_for_human" => $this->timeSlotForHuman,
            "writing_consultation" => $this->writingConsultation,
            "active_step" => $this->activeStep
        ];

        $this->saveAppointmentInSession();
    }
    //Navigate Steps -PREV-
    public function prevStep(): void
    {
        $this->activeStep--;
        $this->appointment = [
            "type" => $this->appointmentType,
            "time_slot_day" => $this->timeSlotDayId,
            "time_slot" => $this->timeSlotId,
            "time_slot_day_for_human" => $this->timeSlotDayForHuman,
            "time_slot_for_human" => $this->timeSlotForHuman,
            "writing_consultation" => $this->writingConsultation,
            "active_step" => $this->activeStep
        ];
        $this->saveAppointmentInSession();
    }

    // Save Appointment Type In array Appointment
    public function selectAppointmentType(string $appointmentType): void
    {
        if($appointmentType == 'writing') {
            $this->timeSlotDayId = null;
            $this->timeSlotId = null;
            $this->timeSlotDayForHuman = null;
            $this->timeSlotForHuman = null;
            $this->appointment["time_slot_day"] = null;
            $this->appointment["time_slot"] = null;
            $this->appointment["time_slot_day_for_human"] = null;
            $this->appointment["time_slot_for_human"] = null;
        }

        $this->priceForHuman = $this->setAmountPriceForHuman($this->amounts[$appointmentType]);

        $this->appointmentType = $appointmentType;

        $this->appointment["type"] = $this->appointmentType;

    }

    // Set Amount for human $this->priceForHuman
    public function setAmountPriceForHuman($amount) {
        $amount = $amount / 100;
        $amount .= '.00 €';

        return $amount;
    }

    // Consultations >>>>>>

    // Edit User Profile
    //Save Birthday
    public function saveBirthday() {

        // Changer le currentValidationForm
        $this->currentValidationForm = 'formBirthDate';

        //Valider l'entrée date
        $validatedData = $this->validate($this->rules(), $this->messages());

        //enregistrer dans le profil utilisateur la date de naissance validée et transformée SB
        $userProfile = Auth::user()->profile;
        $dateWithoutTime = substr($validatedData['birthday'], 0, 10);

        $updateData = $userProfile->update([
            'birthday' => $validatedData['birthday']
        ]);

        // Si la mise à jour réussit, calculer et enregistrer le chemin de vie
        if ($updateData) {
            // Calculer le chemin de vie
            //dump($validatedData['birthday']);
            // $date = Carbon::createFromFormat('Y-m-d H:i:s', $validatedData['birthday'])->format('d/m/Y');
            $numerology = (new Numerology())->calculatePath($dateWithoutTime);
            $tarology = (new Tarot())->calculatePath($dateWithoutTime);
            
            // Mettre à jour le chemin de vie dans le profil utilisateur
            $userProfile->update([
                'numerology' => $numerology,
                'tarology' => $tarology
            ]);

            // Actualiser la page si nécessaire
            $this->dispatch('refreshPage');
        }

    }

    public function saveNativeInformation() {

        // Changer le currentValidationForm
        $this->currentValidationForm = 'formInformationOfBirth';

        //Valider l'entrée date
        $validatedData = $this->validate($this->rules(), $this->messages());

        //enregistrer dans le profil utilisateur la date de naissance validée et transformée SB
        $userProfile = Auth::user()->profile;

        // Construire la structure JSON
        $astrologyData = [
            'time_of_birth' => $this->time_of_birth,
            'city_of_birth' => $this->city_of_birth,
            'native_country' => $this->native_country,
        ];

        $updateData = $userProfile->update([
            'astrology' => $astrologyData
        ]);

        if($updateData) {
            $this->dispatch('refreshPage');
        }

    }

    // Consultation Tchat Or Phone >>>>>>
    //Select Timeslot
    public function selectTimeSlot(int $timeSlotDayId, int $timeSlotId): void
    {
        $this->timeSlotDayId = $timeSlotDayId;
        $this->timeSlotId = $timeSlotId;

        $this->timeSlotDayForHuman = Carbon::parse(TimeSlotDay::where('id', $timeSlotDayId)->firstOrFail()->day)->translatedFormat('l j F Y');
        
        $this->timeSlotForHuman = Carbon::parse(TimeSlot::where('id', $timeSlotId)->firstOrFail()->start_time)->format('H\hi');

        $this->appointment["time_slot_day"] = $this->timeSlotDayId;
        $this->appointment["time_slot"] = $this->timeSlotId;

        $this->appointment["time_slot_day_for_human"] = $this->timeSlotDayForHuman;
        $this->appointment["time_slot_for_human"] = $this->timeSlotForHuman;

    }

    //Navigate Timeslot -NEXT-
    public function nextTimeSlots(): void
    {
        $this->offsetTimeSlot += 5;
        $this->loadTimeSlotDays();
    }
    //Navigate Timeslot -PREV-
    public function prevTimeSlots(): void
    {
        if ($this->offsetTimeSlot == 0) {
            $this->offsetTimeSlot = 0;
        } else {
            $this->offsetTimeSlot -= 5;
        }
        $this->loadTimeSlotDays();
    }

    public function render()
    {
        return view('livewire.appointment-modal');
    }
}
