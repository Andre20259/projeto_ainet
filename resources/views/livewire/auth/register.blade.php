<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\Card;
use Livewire\WithFileUploads;
use App\Services\Payment;

// new #[Layout('components.layouts.auth')] class extends Component {
#[Layout('components.layouts.auth')] class Register extends Component {
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $gender = 'Select one '; // Default
    public ?string $nif = null;
    public ?string $default_delivery_address = null;
    public ?string $default_payment_type = null;
    // public ?string $default_payment_reference = null;
    // public ?string $visa_card_number = null;
    // public ?string $visa_cvc = null;
    // public ?string $paypal_email = null;
    // public ?string $mbway_phone = null;
    public $photo = null;
    

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'gender' => ['required', 'in:Masculino,Feminino'],
            'nif' => ['nullable', 'string', 'max:9'],
            'default_delivery_address' => ['nullable', 'string', 'max:255'],
            'default_payment_type' => ['nullable', 'in:Visa,PayPal,MBWay'],
            // 'default_payment_reference' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:1024'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $validated['type'] = 'pending_member'; // waiting for paid the membership fee

        //nao guardar nada na base de dados se o utilizador nao escolheu o tipo de pagamento
        if (empty($validated['default_payment_type'])) {
            $validated['default_payment_type'] = null;
        }

//         // Verifica se o r de pagamento é valida os dados
//         $paymentValid = true;

//         switch ($validated['default_payment_type']) {
//             case 'Visa':
//                 if (!Payment::payWithVisa($this->visa_card_number, $this->visa_cvc)) {
//                     $this->addError('visa_card_number', 'Invalid VISA card or CVC');
//                     $paymentValid = false;
//                 } else {
//                     $validated['default_payment_reference'] = $this->visa_card_number;
//                 }
//                 break;

//             case 'PayPal':
//                 if (!Payment::payWithPaypal($this->paypal_email)) {
//                     $this->addError('paypal_email', 'Invalid PayPal email');
//                     $paymentValid = false;
//                 } else {
//                     $validated['default_payment_reference'] = $this->paypal_email;
//                 }
//                 break;

//             case 'MB Way':
//                 if (!Payment::payWithMBway($this->mbway_phone)) {
//                     $this->addError('mbway_phone', 'Invalid MB Way phone number');
//                     $paymentValid = false;
//                 } else {
//                     $validated['default_payment_reference'] = $this->mbway_phone;
//                 }
//                 break;
//             }

// if (!$paymentValid) {
//     return; // impede registo se dados de pagamento forem inválidos
// }

        if ($this->photo) {
            $validated['photo'] = $this->photo->store('photos', 'public');
        }

        event(new Registered(($user = User::create($validated))));

        Card::create([
            'id' => $user->id,
            'card_number' => $this->generateCardNumber(),
            'balance' => 0,
        ]);

        Auth::login($user);

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }

    #Gerar cartão virtual para o utilizador
    protected function generateCardNumber(): string
    {
        do {
            $card_number = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (Card::where('card_number', $card_number)->exists());

        return $card_number;
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name"
            :placeholder="__('Full name')" />

        <!-- Email Address -->
        <flux:input wire:model="email" :label="__('Email address')" type="email" required autocomplete="email"
            placeholder="email@example.com" />

        <!-- Password -->
        <flux:input wire:model="password" :label="__('Password')" type="password" required autocomplete="new-password"
            :placeholder="__('Password')" viewable />

        <!-- Confirm Password -->
        <flux:input wire:model="password_confirmation" :label="__('Confirm password')" type="password" required
            autocomplete="new-password" :placeholder="__('Confirm password')" viewable />

        <!-- Genero -->
        <div>
            <label class="text-sm">Gender</label>
            <select wire:model="gender" class="w-full border rounded p-2">
                <option value="">Select one</option>
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
            </select>
        </div>

        <!-- NIF optional -->
        <flux:input wire:model="nif" label="NIF (optional)" type="text" autocomplete="nif" :placeholder="__('Nif')" />

        <!-- Morada optional -->
        <flux:input wire:model="default_delivery_address" label="Delivery Address (optional)" type="text"
            autocomplete="default_delivery_address" :placeholder="__('Delivery Address')" />

        <!-- Dados de Pagamento optional -->
        <div>
            <label class="text-sm">Payment type (optional)</label>
            <select wire:model="default_payment_type" class="w-full border rounded p-2">
                <option value="">Select the Payment type</option>
                <option value="Visa">Visa</option>
                <option value="PayPal">Paypal</option>
                <option value="MB Way">MB Way</option>
            </select>
        </div>

        <!-- Foto optional -->
        <flux:input wire:model="photo" label="Photo (optional)" type="file" />


        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Create account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>