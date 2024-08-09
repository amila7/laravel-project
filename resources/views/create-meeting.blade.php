<!DOCTYPE html>
<html>
<head>
    <title>Create Meeting</title>
</head>
<body>
    <h1>Create Zoom Meeting</h1>
    <form action="{{ url('/create-meeting') }}" method="POST">
        @csrf
        <label for="topic">Topic:</label>
        <input type="text" id="topic" name="topic" required>
        <br>
        <label for="start_time">Start Time (ISO 8601):</label>
        <input type="text" id="start_time" name="start_time" required>
        <br>
        <label for="duration">Duration (minutes):</label>
        <input type="number" id="duration" name="duration" required>
        <br>
        <button type="submit">Create Meeting</button>
    </form>
</body>
</html>
