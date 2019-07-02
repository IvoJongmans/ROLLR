<html>

<head>
    <title>ROLLR - Admin Panel</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
</head>

<body>
<form method="POST" action="/admin_12345/login">
    @csrf
    <section class="section">
        <div class="field">
            <label class="label">
                Admin username</label>
            <div class="control">
                <input class="input" name="username" type="text" placeholder="Text input">
            </div>
        </div>

        <div class="field">
            <label class="label">
                Password</label>
            <div class="control">
                <input class="input" name="password" type="password" placeholder="Text input">
            </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <input class="button is-link" type="submit" value="Login">
            </div>
        </div>
<form>
    </section>



</body>

</html>