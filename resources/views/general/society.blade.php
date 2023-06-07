<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Society</title>
    <style>
        body {
            position: relative;
            background-image: url('{{asset("storage/generals/background.jpg")}}');
            background-size: cover;
            background-position: center;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            background-image: url('{{asset("storage/generals/background.jpg")}}');
            filter: blur(50%);
            z-index: -1;
        }

        .card {
            max-width: 500px;
            margin: 0 auto;
            margin-top: 100px;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            padding: 30px;
        }

        .card-header {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }

        .btn {
            width: 100%;
        }

        img {
            max-width: 200px;
        }

        #feed-container {
            background-color: #f5f8fa;
            padding: 10px;
        }

        .message {
            background-color: #fff;
            border: 1px solid #e6ecf0;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 10px;
        }

        .author {
            font-weight: bold;
        }

        .timestamp {
            color: #8899a6;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div id="feed-container"></div>


    <script>
        // Fetch messages from the back-end
        fetch('/api/messages')
            .then(response => response.json())
            .then(data => {
                // Create HTML elements for each message
                data.forEach(message => {
                    const messageDiv = document.createElement('div');
                    messageDiv.classList.add('message');
                    const authorDiv = document.createElement('div');
                    authorDiv.classList.add('author');
                    authorDiv.innerText = message.author;
                    const contentDiv = document.createElement('div');
                    contentDiv.classList.add('content');
                    contentDiv.innerText = message.content;
                    const timestampDiv = document.createElement('div');
                    timestampDiv.classList.add('timestamp');
                    timestampDiv.innerText = message.timestamp;
                    messageDiv.appendChild(authorDiv);
                    messageDiv.appendChild(contentDiv);
                    messageDiv.appendChild(timestampDiv);
                    feedContainer.appendChild(messageDiv);
                });
            });
    </script>
</body>

</html>