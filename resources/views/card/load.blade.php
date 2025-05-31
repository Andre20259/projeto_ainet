

<form action="{{ route('card.load') }}" method="POST">
    @csrf

    <label>Método:</label>
    <select name="method" required>
        <option value="">Choose</option>
        <option value="visa">VISA</option>
        <option value="paypal">PayPal</option>
        <option value="mbway">MB Way</option>
    </select>

    <div id="visa-fields">
        <input type="text" name="card_number" placeholder="VISA">
        <input type="text" name="cvc" placeholder="CVC (3 dígitos)">
    </div>

    <div id="paypal-fields">
        <input type="email" name="paypal_email" placeholder="PayPal">
    </div>

    <div id="mbway-fields">
        <input type="text" name="mbway_phone" placeholder="MB Way">
    </div>

    <input type="number" name="amount" placeholder="Amount (€)" required min="1">

    <button type="submit">Load</button>
</form>