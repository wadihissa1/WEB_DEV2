<!-- Event creation form -->
<form method="POST" action="{{ route('events.store') }}">
    @csrf
    <label for="name">Event Name:</label>
    <input type="text" name="name" id="name" required>

    <label for="description">Description:</label>
    <textarea name="description" id="description" rows="4" required></textarea>

    <label for="date">Date:</label>
    <input type="date" name="date" id="date" required>

    <label for="time">Time:</label>
    <input type="time" name="time" id="time" required>

    <button type="submit">Create Event</button>
</form>
