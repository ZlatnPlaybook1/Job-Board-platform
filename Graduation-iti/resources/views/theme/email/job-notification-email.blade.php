<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Notification Email</title>
    <style>
        /* Keyframes for fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Keyframes for bounce animation */
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        /* Apply animations */
        h1 {
            animation: fadeIn 2s ease-in-out;
        }

        p {
            animation: fadeIn 2s ease-in-out 0.5s; /* Delay for staggered effect */
        }

        /* Bounce effect for the smiley */
        .smiley {
            display: inline-block;
            animation: bounce 2s infinite;
        }
    </style>
</head>
<body>
    <h1>Hello, My Name is {{ $mailData['employer']->name }}</h1>

    <p>You applied for the job successfully <span class="smiley">😊</span></p>
    <p>Job Title: {{ $mailData['employment_post']->title }}</p>

    <p>Employee Details:</p>

    <p>Name: {{ $mailData['user']->name }}</p>
    <p>Email: {{ $mailData['user']->email }}</p>
    <p>Mobile No: {{ $mailData['user']->mobile }}</p>
</body>
</html>
