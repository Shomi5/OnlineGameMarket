<x-layoutFX>
    <form action="/prodaja/obradaPoruke" method="POST">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required>
    
        <label>Poruka:</label>
        <textarea name="message" required></textarea>
    
        <button type="submit">Pošalji</button>
    </form>
</x-layoutFX>    