<!DOCTYPE html>
<html>
<head>
    <title>Pesan Kontak Baru</title>
</head>
<body>
    <h2>Pesan Baru dari {{ $data['name'] }}</h2>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Subjek:</strong> {{ $data['subject'] }}</p>
    <p><strong>Pesan:</strong></p>
    <p>{{ $data['message'] }}</p>
</body>
</html>