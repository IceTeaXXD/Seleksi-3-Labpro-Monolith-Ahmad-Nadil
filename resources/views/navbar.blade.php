<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
    @import url(https://fonts.googleapis.com/css?family=Poppins:300);

    * {
        font-family: Poppins;
    }

    .navbar {
        z-index: 9999;
    }

    .navbar-nav>li>a {
        position: relative;
        padding-bottom: 5px;
    }

    .navbar-nav>li>a:hover::after,
    .navbar-nav>li.active>a::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 1px;
        background: #fff;
        border-bottom: 1px solid #fff;
        border: 1px solid #fff;
    }
</style>

<div class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="navbar-header">
                    <button class="navbar-toggle" data-target="#mobile_menu" data-toggle="collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    <a href="/" class="navbar-brand">MONOLITH APP</a>
                </div>
                <?php
                // check if session username is set, if so, then display the navbar
                if (session('username')) {
                    echo '
                    <div class="navbar-collapse collapse" id="mobile_menu">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="/">Home</a></li>
                            <li><a href="/catalog">Catalog</a></li>
                            <li><a href="/history">Purchase History</a></li>
                            <li><a href="/logout">Sign Out</a></li>
                        </ul>
                    </div>
                    ';
                } else {
                    echo '
                    <div class="navbar-collapse collapse" id="mobile_menu">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="/">Home</a></li>
                            <li><a href="/login">Sign In</a></li>
                            <li><a href="/register">Sign Up</a></li>
                        </ul>
                    </div>
                    ';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $(".navbar-nav > li > a").on("click", function() {
            $(".navbar-nav > li").removeClass("active");
            $(this).parent().addClass("active");
        });
    });

    // check the url, and add the active class, if home, then add it to home link
    var url = window.location.href;
    var activePage = url;
    $('.navbar-nav li a').each(function() {
        var linkPage = this.href;
        if (activePage == linkPage) {
            $(this).closest("li").addClass("active");
        }
    });
</script>


<!-- <!DOCTYPE html>
<html lang="en">
<style>
    * {
        margin: 0;
        padding: 0;
        color: #f2f5f7;
        font-family: sans-serif;
        letter-spacing: 1px;
        font-weight: 300;
    }

    body {
        overflow-x: hidden;
    }

    nav {
        height: 4.5rem;
        width: 100vw;
        background-color: #131418;
        box-shadow: 0 3px 20px rgba(0, 0, 0, 0.2);
        display: flex;
        position: fixed;
        z-index: 10;
    }

    /*Styling logo*/
    .logo {
        padding: 1vh 1vw;
        text-align: center;
    }

    .logo img {
        height: 5rem;
        width: 5rem;
    }

    /*Styling Links*/
    .nav-links {
        display: flex;
        list-style: none;
        width: 88vw;
        padding: 0 0.7vw;
        justify-content: space-evenly;
        align-items: center;
        text-transform: uppercase;
    }

    .nav-links li a {
        text-decoration: none;
        margin: 0 0.7vw;
    }

    .nav-links li a:hover {
        color: #61DAFB;
    }

    .nav-links li {
        position: relative;
    }

    .nav-links li a:hover::before {
        width: 80%;
    }

    /*Styling Buttons*/
    .login-button {
        background-color: transparent;
        border: 1.5px solid #f2f5f7;
        border-radius: 2em;
        padding: 0.6rem 0.8rem;
        margin-left: 2vw;
        font-size: 1rem;
        cursor: pointer;

    }

    .login-button:hover {
        color: #131418;
        background-color: #f2f5f7;
        border: 1.5px solid #f2f5f7;
        transition: all ease-in-out 350ms;
    }

    .join-button {
        color: #131418;
        background-color: #61DAFB;
        border: 1.5px solid #61DAFB;
        border-radius: 2em;
        padding: 0.6rem 0.8rem;
        font-size: 1rem;
        cursor: pointer;
    }

    .join-button:hover {
        color: #f2f5f7;
        background-color: transparent;
        border: 1.5px solid #f2f5f7;
        transition: all ease-in-out 350ms;
    }

    /*Styling Hamburger Icon*/
    .hamburger div {
        width: 30px;
        height: 3px;
        background: #f2f5f7;
        margin: 5px;
        transition: all 0.3s ease;
    }

    .hamburger {
        display: none;
    }

    /*Stying for small screens*/
    @media screen and (max-width: 800px) {
        nav {
            position: fixed;
            z-index: 3;
        }

        .hamburger {
            display: block;
            position: absolute;
            cursor: pointer;
            right: 5%;
            top: 50%;
            transform: translate(-5%, -50%);
            z-index: 2;
            transition: all 0.7s ease;
        }

        .nav-links {
            position: fixed;
            background: #131418;
            height: 100vh;
            width: 100%;
            flex-direction: column;
            clip-path: circle(50px at 90% -20%);
            -webkit-clip-path: circle(50px at 90% -10%);
            transition: all 1s ease-out;
            pointer-events: none;
        }

        .nav-links.open {
            clip-path: circle(1000px at 90% -10%);
            -webkit-clip-path: circle(1000px at 90% -10%);
            pointer-events: all;
        }

        .nav-links li {
            opacity: 0;
        }

        .nav-links li:nth-child(1) {
            transition: all 0.5s ease 0.2s;
        }

        .nav-links li:nth-child(2) {
            transition: all 0.5s ease 0.4s;
        }

        .nav-links li:nth-child(3) {
            transition: all 0.5s ease 0.6s;
        }

        .nav-links li:nth-child(4) {
            transition: all 0.5s ease 0.7s;
        }

        .nav-links li:nth-child(5) {
            transition: all 0.5s ease 0.8s;
        }

        .nav-links li:nth-child(6) {
            transition: all 0.5s ease 0.9s;
            margin: 0;
        }

        .nav-links li:nth-child(7) {
            transition: all 0.5s ease 1s;
            margin: 0;
        }

        li.fade {
            opacity: 1;
        }
    }

    /*Animating Hamburger Icon on Click*/
    .toggle .line1 {
        transform: rotate(-45deg) translate(-5px, 6px);
    }

    .toggle .line2 {
        transition: all 0.7s ease;
        width: 0;
    }

    .toggle .line3 {
        transform: rotate(45deg) translate(-5px, -6px);
    }
</style>

<script>
    const hamburger = document.querySelector(".hamburger");
    const navLinks = document.querySelector(".nav-links");
    const links = document.querySelectorAll(".nav-links li");

    hamburger.addEventListener('click', () => {
        //Animate Links
        navLinks.classList.toggle("open");
        links.forEach(link => {
            link.classList.toggle("fade");
        });

        //Hamburger Animation
        hamburger.classList.toggle("toggle");
    });
</script>

<body>
    <nav>
        <div class="logo" style="display: flex;align-items: center;">
            <span style="color:#01939c; font-size:26px; font-weight:bold; letter-spacing: 1px;margin-left: 20px;">MONOLITH</span>
        </div>
        <div class="hamburger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        <ul class="nav-links">
            <li><a href="/">Home</a></li>
            <li><a href="/login">Sign In</a></li>
            <li><a href="/register">Sign Up</a></li>
            <li><a href="#">Sign Out</a></li>
            <li><a href="/catalog">Catalog</a></li>
            <li><a href="#">Purchase History</a></li>
        </ul>
    </nav>
</body>

</html> -->