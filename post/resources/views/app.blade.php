<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lumen and Vue</title>
        <link rel="stylesheet" href="dist/app.css" />
    </head>
    <body> 
        <div id="app">
            <nav class="navbar navbar-expand-sm navbar-dark bg-info mb-2">
                <div class="container">
                    <a href="#" class="navbar-brand">TIAC Social</a>
                    <li><router-link to="/login">Login</router-link></li>
                    <li><router-link to="/register">Register</router-link></li>
                </div>
            </nav>
        <h1>LV</h1>
            <h1>Hello App!</h1>
            <p>
<!--                 <router-link to="/login">Log in</router-link>
                <router-link to="/register">Sign up</router-link>
                <router-link to="/foo">Go to Foo</router-link>
                <router-link to="/bar">Go to Bar</router-link> -->
            </p>

            <router-view></router-view>
        </div>
        <script src="dist/app.js"></script>
    </body>
</html>
