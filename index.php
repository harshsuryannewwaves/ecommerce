<?php
session_start();
$user = $_SESSION['user'] ?? null;
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Al Omaira Printing & Publishing Co. L.L.C.</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/vendor.css">
  <link rel="stylesheet" type="text/css" href="style.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>

<body>
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <defs>
      <symbol xmlns="http://www.w3.org/2000/svg" id="link" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 19a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0-4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm-5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm7-12h-1V2a1 1 0 0 0-2 0v1H8V2a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3Zm1 17a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-9h16Zm0-11H4V6a1 1 0 0 1 1-1h1v1a1 1 0 0 0 2 0V5h8v1a1 1 0 0 0 2 0V5h1a1 1 0 0 1 1 1ZM7 15a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0 4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="arrow-right" viewBox="0 0 24 24">
        <path fill="currentColor" d="M17.92 11.62a1 1 0 0 0-.21-.33l-5-5a1 1 0 0 0-1.42 1.42l3.3 3.29H7a1 1 0 0 0 0 2h7.59l-3.3 3.29a1 1 0 0 0 0 1.42a1 1 0 0 0 1.42 0l5-5a1 1 0 0 0 .21-.33a1 1 0 0 0 0-.76Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="category" viewBox="0 0 24 24">
        <path fill="currentColor" d="M19 5.5h-6.28l-.32-1a3 3 0 0 0-2.84-2H5a3 3 0 0 0-3 3v13a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-10a3 3 0 0 0-3-3Zm1 13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-13a1 1 0 0 1 1-1h4.56a1 1 0 0 1 .95.68l.54 1.64a1 1 0 0 0 .95.68h7a1 1 0 0 1 1 1Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="calendar" viewBox="0 0 24 24">
        <path fill="currentColor" d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3Zm1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="heart" viewBox="0 0 24 24">
        <path fill="currentColor" d="M20.16 4.61A6.27 6.27 0 0 0 12 4a6.27 6.27 0 0 0-8.16 9.48l7.45 7.45a1 1 0 0 0 1.42 0l7.45-7.45a6.27 6.27 0 0 0 0-8.87Zm-1.41 7.46L12 18.81l-6.75-6.74a4.28 4.28 0 0 1 3-7.3a4.25 4.25 0 0 1 3 1.25a1 1 0 0 0 1.42 0a4.27 4.27 0 0 1 6 6.05Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="plus" viewBox="0 0 24 24">
        <path fill="currentColor" d="M19 11h-6V5a1 1 0 0 0-2 0v6H5a1 1 0 0 0 0 2h6v6a1 1 0 0 0 2 0v-6h6a1 1 0 0 0 0-2Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="minus" viewBox="0 0 24 24">
        <path fill="currentColor" d="M19 11H5a1 1 0 0 0 0 2h14a1 1 0 0 0 0-2Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="cart" viewBox="0 0 24 24">
        <path fill="currentColor" d="M8.5 19a1.5 1.5 0 1 0 1.5 1.5A1.5 1.5 0 0 0 8.5 19ZM19 16H7a1 1 0 0 1 0-2h8.491a3.013 3.013 0 0 0 2.885-2.176l1.585-5.55A1 1 0 0 0 19 5H6.74a3.007 3.007 0 0 0-2.82-2H3a1 1 0 0 0 0 2h.921a1.005 1.005 0 0 1 .962.725l.155.545v.005l1.641 5.742A3 3 0 0 0 7 18h12a1 1 0 0 0 0-2Zm-1.326-9l-1.22 4.274a1.005 1.005 0 0 1-.963.726H8.754l-.255-.892L7.326 7ZM16.5 19a1.5 1.5 0 1 0 1.5 1.5a1.5 1.5 0 0 0-1.5-1.5Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="check" viewBox="0 0 24 24">
        <path fill="currentColor" d="M18.71 7.21a1 1 0 0 0-1.42 0l-7.45 7.46l-3.13-3.14A1 1 0 1 0 5.29 13l3.84 3.84a1 1 0 0 0 1.42 0l8.16-8.16a1 1 0 0 0 0-1.47Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="trash" viewBox="0 0 24 24">
        <path fill="currentColor" d="M10 18a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1ZM20 6h-4V5a3 3 0 0 0-3-3h-2a3 3 0 0 0-3 3v1H4a1 1 0 0 0 0 2h1v11a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8h1a1 1 0 0 0 0-2ZM10 5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v1h-4Zm7 14a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8h10Zm-3-1a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="star-outline" viewBox="0 0 15 15">
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M7.5 9.804L5.337 11l.413-2.533L4 6.674l2.418-.37L7.5 4l1.082 2.304l2.418.37l-1.75 1.793L9.663 11L7.5 9.804Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="star-solid" viewBox="0 0 15 15">
        <path fill="currentColor" d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="search" viewBox="0 0 24 24">
        <path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="user" viewBox="0 0 24 24">
        <path fill="currentColor" d="M15.71 12.71a6 6 0 1 0-7.42 0a10 10 0 0 0-6.22 8.18a1 1 0 0 0 2 .22a8 8 0 0 1 15.9 0a1 1 0 0 0 1 .89h.11a1 1 0 0 0 .88-1.1a10 10 0 0 0-6.25-8.19ZM12 12a4 4 0 1 1 4-4a4 4 0 0 1-4 4Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="close" viewBox="0 0 15 15">
        <path fill="currentColor" d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z" />
      </symbol>
    </defs>
  </svg>
  <div class="preloader-wrapper">
    <div class="preloader">
    </div>
  </div>

  <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasSearch" aria-labelledby="Search">
    <div class="offcanvas-header justify-content-center">
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div class="order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Search</span>
        </h4>
        <form role="search" action="index.html" method="get" class="d-flex mt-3 gap-0">
          <input class="form-control rounded-start rounded-0 bg-light" type="email" placeholder="What are you looking for?" aria-label="What are you looking for?">
          <button class="btn btn-dark rounded-end rounded-0" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>

  <header>
    <div class="container-fluid">
      <div class="row py-3 border-bottom">

        <div class="col-sm-4 col-lg-3 text-center text-sm-start">
          <div class="main-logo">
            <a href="index.html">
              <img src="images/logo/OMAIRA LLC_page-0001.jpg" alt="logo" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-5 d-none d-lg-block">
          <div class="search-bar row bg-light p-2 my-2 rounded-4">
            <div class="col-md-4 d-none d-md-block">
              <select class="form-select border-0 bg-transparent">
                <option>All Categories</option>
                <option>Office Products</option>
                <option>Branding</option>
                <option>Stationary</option>
                <option>Home Decor</option>
                <option>Gift Ideas</option>
              </select>
            </div>
            <div class="col-11 col-md-7">
              <form id="search-form" class="text-center" action="index.html" method="post">
                <input type="text" class="form-control border-0 bg-transparent" placeholder="Search for products" />
              </form>
            </div>
            <div class="col-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
              </svg>
            </div>
          </div>
        </div>

        <div class="col-sm-8 col-lg-4 d-flex justify-content-end gap-5 align-items-center mt-4 mt-sm-0 justify-content-center justify-content-sm-end">
          <div class="support-box text-end d-none d-xl-block">
            <span class="fs-6 text-muted">For Support?</span>
            <h5 class="mb-0">+971 4 4427840</h5>
          </div>

          <ul class="d-flex justify-content-end list-unstyled m-0">
            <li class="nav-item dropdown" id="user-menu"></li>
            <li>
              <a href="#" class="rounded-circle bg-light p-2 mx-1">
                <svg width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="#heart"></use>
                </svg>
              </a>
            </li>
            
            <li class="d-lg-none">
              <a href="#" class="rounded-circle bg-light p-2 mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch" aria-controls="offcanvasSearch">
                <svg width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="#search"></use>
                </svg>
              </a>
            </li>
          </ul>

          <div class="cart text-end d-none d-lg-block dropdown">
          <a href="backend/views/cart.php" class="rounded-circle bg-light p-2 mx-1">
                <svg width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="#cart"></use>
                </svg>
              </a>
          </div>
        </div>

      </div>
    </div>
    <div class="container-fluid">
      <div class="row py-3">
        <div class="d-flex  justify-content-center justify-content-sm-between align-items-center">
          <nav class="main-menu d-flex navbar navbar-expand-lg">

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
              aria-controls="offcanvasNavbar">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

              <div class="offcanvas-header justify-content-center">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>

              <div class="offcanvas-body">

                <div class="collapse navbar-collapse show" id="navbarNavDropdown">
                  <ul class="navbar-nav ms-auto">
                    <!-- Office Products Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="officeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Office Products
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="officeDropdown">
                        <li><a class="dropdown-item" href="#">Customized Pens</a></li>
                        <li><a class="dropdown-item" href="#">Custom Notebooks & Diaries</a></li>
                        <li><a class="dropdown-item" href="#">Personalized Bottles & Tumblers</a></li>
                      </ul>
                    </li>

                    <!-- Branding Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="brandingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Branding
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="brandingDropdown">
                        <li><a class="dropdown-item" href="#">Give Aways</a></li>
                        <li><a class="dropdown-item" href="#">Apparels & Accessories</a></li>
                        <li><a class="dropdown-item" href="#">Electronic Items</a></li>
                        <li><a class="dropdown-item" href="#">Signages</a></li>
                        <li><a class="dropdown-item" href="#">Other Branding Ideas</a></li>
                        <li><a class="dropdown-item" href="#">Medals, Awards & Trophies</a></li>
                        <li><a class="dropdown-item" href="#">USB - Flash Drives</a></li>
                        <li><a class="dropdown-item" href="#">Pen and Portfolio Folders</a></li>
                        <li><a class="dropdown-item" href="#">Eco Friendly Products</a></li>
                        <li><a class="dropdown-item" href="#">Personalized Gift Sets</a></li>
                      </ul>
                    </li>

                    <!-- Stationery Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="stationeryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Stationery
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="stationeryDropdown">
                        <li><a class="dropdown-item" href="#">Business Cards</a></li>
                        <li><a class="dropdown-item" href="#">Letter Heads</a></li>
                        <li><a class="dropdown-item" href="#">Envelopes</a></li>
                        <li><a class="dropdown-item" href="#">Bill Books</a></li>
                        <li><a class="dropdown-item" href="#">Other Stationery Products</a></li>
                        <li><a class="dropdown-item" href="#">Self Ink Rubber Stamps</a></li>
                        <li><a class="dropdown-item" href="#">NFC</a></li>
                      </ul>
                    </li>

                    <!-- Home Decor Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="decorDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Home Decor
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="decorDropdown">
                        <li><a class="dropdown-item" href="#">Large Format Prints</a></li>
                        <li><a class="dropdown-item" href="#">Home Signages</a></li>
                        <li><a class="dropdown-item" href="#">Home Decor Ideas</a></li>
                      </ul>
                    </li>

                    <!-- Gift Ideas Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="giftDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Gift Ideas
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="giftDropdown">
                        <li><a class="dropdown-item" href="#">Apparels & Accessories</a></li>
                        <li><a class="dropdown-item" href="#">Electronic Items</a></li>
                        <li><a class="dropdown-item" href="#">Unique Gift Ideas</a></li>
                        <li><a class="dropdown-item" href="#">Regular Gift Ideas</a></li>
                        <li><a class="dropdown-item" href="#">Gift Bags</a></li>
                        <li><a class="dropdown-item" href="#">Artist Jobs</a></li>
                        <li><a class="dropdown-item" href="#">Valentines Day Gifts</a></li>
                        <li><a class="dropdown-item" href="#">Gifts for Her</a></li>
                        <li><a class="dropdown-item" href="#">Gifts for Him</a></li>
                      </ul>
                    </li>

                    <!-- Static Link Example -->
                    <li class="nav-item">
                      <a class="nav-link" href="#nextdaydelivery">Next Day Delivery</a>
                    </li>
                  </ul>
                </div>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                  <ul class="navbar-nav ms-auto">
                    <!-- Branding Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="brandingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>Currency:</span>
                        AED
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="brandingDropdown">
                        <li><a class="dropdown-item" href="#" title="GBP">GBP British Pound Sterling</a></li>
                        <li><a class="dropdown-item" href="#" title="SAR"> Saudi Riyal</a></li>
                        <li><a class="dropdown-item" href="#" title="AED"> United Arab Emirates Dirham</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>

              </div>

            </div>
        </div>
      </div>
    </div>
  </header>

  <section id="imageSlider" class="py-3">
    <div class="container-fluid px-0">
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

        <!-- Indicators -->
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="6"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="7"></button>
        </div>

        <!-- Slides -->
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="images/productdummy.jpg" class="d-block w-100" alt="Slide 2">
          </div>
          <div class="carousel-item">
            <img src="images/productdummy.jpg" class="d-block w-100" alt="Slide 1">
          </div>
          <div class="carousel-item">
            <img src="images/productdummy.jpg" class="d-block w-100" alt="Slide 3">
          </div>
          <div class="carousel-item">
            <img src="images/productdummy.jpg" class="d-block w-100" alt="Slide 4">
          </div>
          <div class="carousel-item">
            <img src="images/productdummy.jpg" class="d-block w-100" alt="Slide 5">
          </div>
          <div class="carousel-item">
            <img src="images/productdummy.jpg" class="d-block w-100" alt="Slide 6">
          </div>
          <div class="carousel-item">
            <img src="images/productdummy.jpg" class="d-block w-100" alt="Slide 7">
          </div>
          <div class="carousel-item">
            <img src="images/productdummy.jpg" class="d-block w-100" alt="Slide 8">
          </div>
        </div>

      </div>
    </div>
  </section>


  <section class="py-4 overflow-hidden">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="section-header d-flex flex-wrap justify-content-between mb-5">
            <h2 class="section-title">Category</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="category-grid d-flex flex-wrap justify-content-between">
            <a href="index.html" class="nav-link category-item">
              <img src="images/category icons/office product.jpg" alt="Category Thumbnail" height="150">
              <h3 class="category-title">Office Products</h3>
            </a>
            <a href="index.html" class="nav-link category-item">
              <img src="images/category icons/branding.jpg" alt="Category Thumbnail" height="150">
              <h3 class="category-title">Branding</h3>
            </a>
            <a href="index.html" class="nav-link category-item">
              <img src="images/category icons/stationary.jpg" alt="Category Thumbnail" height="150">
              <h3 class="category-title">Stationary</h3>
            </a>
            <a href="index.html" class="nav-link category-item">
              <img src="images/category icons/home decor.jpg" alt="Category Thumbnail" height="150">
              <h3 class="category-title">Home Decor</h3>
            </a>
            <a href="index.html" class="nav-link category-item">
              <img src="images/category icons/gift.jpg" alt="Category Thumbnail" height="150">
              <h3 class="category-title">Gift Ideas</h3>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>



  <section class="py-5 overflow-hidden">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

          <div class="section-header d-flex flex-wrap flex-wrap justify-content-between mb-5">

            <h2 class="section-title">Newly Arrived Brands</h2>

            <div class="d-flex align-items-center">
              <a href="#" class="btn-link text-decoration-none">View All Categories →</a>
              <div class="swiper-buttons">
                <button class="swiper-prev brand-carousel-prev btn btn-yellow">❮</button>
                <button class="swiper-next brand-carousel-next btn btn-yellow">❯</button>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="row">
        <div class="col-md-12">

          <div class="brand-carousel swiper">
            <div class="swiper-wrapper">

              <div class="swiper-slide">
                <div class="card mb-3 p-3 rounded-4 shadow border-0">
                  <div class="row g-0">
                    <div class="col-md-12">
                      <img src="images/dummy4.jpg" class="img-fluid rounded" alt="Card title">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body py-0">
                        <p class="text-muted mb-0">Inspirational Quote Ceramic Mug</p>
                        <h5 class="card-title">Start your mornings with motivation.</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="card mb-3 p-3 rounded-4 shadow border-0">
                  <div class="row g-0">
                    <div class="col-md-12">
                      <img src="images/dummy4.jpg" class="img-fluid rounded" alt="Card title">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body py-0">
                        <p class="text-muted mb-0">Stylish AirPods Protective Case</p>
                        <h5 class="card-title">Give your AirPods a touch of personality.</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="card mb-3 p-3 rounded-4 shadow border-0">
                  <div class="row g-0">
                    <div class="col-md-12">
                      <img src="images/dummy4.jpg" class="img-fluid rounded" alt="Card title">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body py-0">
                        <p class="text-muted mb-0">Custom Laptop Skin</p>
                        <h5 class="card-title">Protective, vibrant, peel-proof, <br>custom fit.</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="card mb-3 p-3 rounded-4 shadow border-0">
                  <div class="row g-0">
                    <div class="col-md-12">
                      <img src="images/dummy4.jpg" class="img-fluid rounded" alt="Card title">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body py-0">
                        <p class="text-muted mb-0">Unisub Sublimation Product Range</p>
                        <h5 class="card-title">High-quality blanks, ready for your imagination.</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="card mb-3 p-3 rounded-4 shadow border-0">
                  <div class="row g-0">
                    <div class="col-md-12">
                      <img src="images/dummy4.jpg" class="img-fluid rounded" alt="Card title">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body py-0">
                        <p class="text-muted mb-0">Temporary Tattoo Art</p>
                        <h5 class="card-title">your story with our collection of temporary tattoos.</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="card mb-3 p-3 rounded-4 shadow border-0">
                  <div class="row g-0">
                    <div class="col-md-12">
                      <img src="images/dummy4.jpg" class="img-fluid rounded" alt="Card title">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body py-0">
                        <p class="text-muted mb-0">Custom Printed Tissue Paper</p>
                        <h5 class="card-title">Add a premium touch to your packaging.</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </section>


  <section class="py-5">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">

          <div class="bootstrap-tabs product-tabs">
            <div class="tabs-header d-flex justify-content-between border-bottom my-5">
              <h3>Products</h3>
              <!-- <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a href="#" class="nav-link text-uppercase fs-6 active" id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all">All</a>
                    <a href="#" class="nav-link text-uppercase fs-6" id="nav-fruits-tab" data-bs-toggle="tab" data-bs-target="#nav-fruits">Fruits & Veges</a>
                    <a href="#" class="nav-link text-uppercase fs-6" id="nav-juices-tab" data-bs-toggle="tab" data-bs-target="#nav-juices">Juices</a>
                  </div>
                </nav> -->
            </div>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">

                <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">

                  <div class="col">
                    <div class="product-item">
                      <span class="badge bg-success position-absolute m-3">-30%</span>
                      <a href="#" class="btn-wishlist"><svg width="24" height="24">
                          <use xlink:href="#heart"></use>
                        </svg></a>
                      <figure>
                        <a href="index.html" title="Product Title">
                          <img src="images/dummy4.jpg" class="tab-image">
                        </a>
                      </figure>
                      <h3>Sunstar Fresh Melon Juice</h3>
                      <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                          <use xlink:href="#star-solid"></use>
                        </svg> 4.5</span>
                      <!-- <span class="price">$18.00</span> -->
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="input-group product-qty">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16">
                                <use xlink:href="#minus"></use>
                              </svg>
                            </button>
                          </span>
                          <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                              <svg width="16" height="16">
                                <use xlink:href="#plus"></use>
                              </svg>
                            </button>
                          </span>
                        </div>
                        <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                      </div>
                    </div>
                  </div>

                  <div class="col">
                    <div class="product-item">
                      <span class="badge bg-success position-absolute m-3">-30%</span>
                      <a href="#" class="btn-wishlist"><svg width="24" height="24">
                          <use xlink:href="#heart"></use>
                        </svg></a>
                      <figure>
                        <a href="index.html" title="Product Title">
                          <img src="images/dummy4.jpg" class="tab-image">
                        </a>
                      </figure>
                      <h3>Sunstar Fresh Melon Juice</h3>
                      <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                          <use xlink:href="#star-solid"></use>
                        </svg> 4.5</span>
                      <!-- <span class="price">$18.00</span> -->
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="input-group product-qty">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16">
                                <use xlink:href="#minus"></use>
                              </svg>
                            </button>
                          </span>
                          <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                              <svg width="16" height="16">
                                <use xlink:href="#plus"></use>
                              </svg>
                            </button>
                          </span>
                        </div>
                        <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                      </div>
                    </div>
                  </div>

                  <div class="col">
                    <div class="product-item">
                      <a href="#" class="btn-wishlist"><svg width="24" height="24">
                          <use xlink:href="#heart"></use>
                        </svg></a>
                      <figure>
                        <a href="index.html" title="Product Title">
                          <img src="images/dummy4.jpg" class="tab-image">
                        </a>
                      </figure>
                      <h3>Sunstar Fresh Melon Juice</h3>
                      <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                          <use xlink:href="#star-solid"></use>
                        </svg> 4.5</span>
                      <!-- <span class="price">$18.00</span> -->
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="input-group product-qty">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16">
                                <use xlink:href="#minus"></use>
                              </svg>
                            </button>
                          </span>
                          <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                              <svg width="16" height="16">
                                <use xlink:href="#plus"></use>
                              </svg>
                            </button>
                          </span>
                        </div>
                        <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                      </div>
                    </div>
                  </div>

                  <div class="col">
                    <div class="product-item">
                      <a href="#" class="btn-wishlist"><svg width="24" height="24">
                          <use xlink:href="#heart"></use>
                        </svg></a>
                      <figure>
                        <a href="index.html" title="Product Title">
                          <img src="images/dummy4.jpg" class="tab-image">
                        </a>
                      </figure>
                      <h3>Sunstar Fresh Melon Juice</h3>
                      <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                          <use xlink:href="#star-solid"></use>
                        </svg> 4.5</span>
                      <!-- <span class="price">$18.00</span> -->
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="input-group product-qty">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16">
                                <use xlink:href="#minus"></use>
                              </svg>
                            </button>
                          </span>
                          <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                              <svg width="16" height="16">
                                <use xlink:href="#plus"></use>
                              </svg>
                            </button>
                          </span>
                        </div>
                        <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                      </div>
                    </div>
                  </div>

                  <div class="col">
                    <div class="product-item">
                      <a href="#" class="btn-wishlist"><svg width="24" height="24">
                          <use xlink:href="#heart"></use>
                        </svg></a>
                      <figure>
                        <a href="index.html" title="Product Title">
                          <img src="images/dummy4.jpg" class="tab-image">
                        </a>
                      </figure>
                      <h3>Sunstar Fresh Melon Juice</h3>
                      <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                          <use xlink:href="#star-solid"></use>
                        </svg> 4.5</span>
                      <!-- <span class="price">$18.00</span> -->
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="input-group product-qty">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16">
                                <use xlink:href="#minus"></use>
                              </svg>
                            </button>
                          </span>
                          <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                              <svg width="16" height="16">
                                <use xlink:href="#plus"></use>
                              </svg>
                            </button>
                          </span>
                        </div>
                        <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                      </div>
                    </div>
                  </div>

                  <div class="col">
                    <div class="product-item">
                      <a href="#" class="btn-wishlist"><svg width="24" height="24">
                          <use xlink:href="#heart"></use>
                        </svg></a>
                      <figure>
                        <a href="index.html" title="Product Title">
                          <img src="images/dummy4.jpg" class="tab-image">
                        </a>
                      </figure>
                      <h3>Sunstar Fresh Melon Juice</h3>
                      <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                          <use xlink:href="#star-solid"></use>
                        </svg> 4.5</span>
                      <!-- <span class="price">$18.00</span> -->
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="input-group product-qty">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16">
                                <use xlink:href="#minus"></use>
                              </svg>
                            </button>
                          </span>
                          <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                              <svg width="16" height="16">
                                <use xlink:href="#plus"></use>
                              </svg>
                            </button>
                          </span>
                        </div>
                        <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                      </div>
                    </div>
                  </div>

                  <div class="col">
                    <div class="product-item">
                      <a href="#" class="btn-wishlist"><svg width="24" height="24">
                          <use xlink:href="#heart"></use>
                        </svg></a>
                      <figure>
                        <a href="index.html" title="Product Title">
                          <img src="images/dummy4.jpg" class="tab-image">
                        </a>
                      </figure>
                      <h3>Sunstar Fresh Melon Juice</h3>
                      <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                          <use xlink:href="#star-solid"></use>
                        </svg> 4.5</span>
                      <!-- <span class="price">$18.00</span> -->
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="input-group product-qty">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16">
                                <use xlink:href="#minus"></use>
                              </svg>
                            </button>
                          </span>
                          <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                              <svg width="16" height="16">
                                <use xlink:href="#plus"></use>
                              </svg>
                            </button>
                          </span>
                        </div>
                        <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                      </div>
                    </div>
                  </div>

                  <div class="col">
                    <div class="product-item">
                      <a href="#" class="btn-wishlist"><svg width="24" height="24">
                          <use xlink:href="#heart"></use>
                        </svg></a>
                      <figure>
                        <a href="index.html" title="Product Title">
                          <img src="images/dummy4.jpg" class="tab-image">
                        </a>
                      </figure>
                      <h3>Sunstar Fresh Melon Juice</h3>
                      <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                          <use xlink:href="#star-solid"></use>
                        </svg> 4.5</span>
                      <!-- <span class="price">$18.00</span> -->
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="input-group product-qty">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16">
                                <use xlink:href="#minus"></use>
                              </svg>
                            </button>
                          </span>
                          <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                              <svg width="16" height="16">
                                <use xlink:href="#plus"></use>
                              </svg>
                            </button>
                          </span>
                        </div>
                        <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                      </div>
                    </div>
                  </div>

                  <div class="col">
                    <div class="product-item">
                      <a href="#" class="btn-wishlist"><svg width="24" height="24">
                          <use xlink:href="#heart"></use>
                        </svg></a>
                      <figure>
                        <a href="index.html" title="Product Title">
                          <img src="images/dummy4.jpg" class="tab-image">
                        </a>
                      </figure>
                      <h3>Sunstar Fresh Melon Juice</h3>
                      <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                          <use xlink:href="#star-solid"></use>
                        </svg> 4.5</span>
                      <!-- <span class="price">$18.00</span> -->
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="input-group product-qty">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16">
                                <use xlink:href="#minus"></use>
                              </svg>
                            </button>
                          </span>
                          <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                              <svg width="16" height="16">
                                <use xlink:href="#plus"></use>
                              </svg>
                            </button>
                          </span>
                        </div>
                        <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                      </div>
                    </div>
                  </div>

                  <div class="col">
                    <div class="product-item">
                      <a href="#" class="btn-wishlist"><svg width="24" height="24">
                          <use xlink:href="#heart"></use>
                        </svg></a>
                      <figure>
                        <a href="index.html" title="Product Title">
                          <img src="images/dummy4.jpg" class="tab-image">
                        </a>
                      </figure>
                      <h3>Sunstar Fresh Melon Juice</h3>
                      <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                          <use xlink:href="#star-solid"></use>
                        </svg> 4.5</span>
                      <!-- <span class="price">$18.00</span> -->
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="input-group product-qty">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16">
                                <use xlink:href="#minus"></use>
                              </svg>
                            </button>
                          </span>
                          <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                              <svg width="16" height="16">
                                <use xlink:href="#plus"></use>
                              </svg>
                            </button>
                          </span>
                        </div>
                        <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="product-item">
                      <a href="#" class="btn-wishlist"><svg width="24" height="24">
                          <use xlink:href="#heart"></use>
                        </svg></a>
                      <figure>
                        <a href="index.html" title="Product Title">
                          <img src="images/dummy4.jpg" class="tab-image">
                        </a>
                      </figure>
                      <h3>Sunstar Fresh Melon Juice</h3>
                      <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                          <use xlink:href="#star-solid"></use>
                        </svg> 4.5</span>
                      <!-- <span class="price">$18.00</span> -->
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="input-group product-qty">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16">
                                <use xlink:href="#minus"></use>
                              </svg>
                            </button>
                          </span>
                          <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                              <svg width="16" height="16">
                                <use xlink:href="#plus"></use>
                              </svg>
                            </button>
                          </span>
                        </div>
                        <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="product-item">
                      <a href="#" class="btn-wishlist"><svg width="24" height="24">
                          <use xlink:href="#heart"></use>
                        </svg></a>
                      <figure>
                        <a href="index.html" title="Product Title">
                          <img src="images/dummy4.jpg" class="tab-image">
                        </a>
                      </figure>
                      <h3>Sunstar Fresh Melon Juice</h3>
                      <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                          <use xlink:href="#star-solid"></use>
                        </svg> 4.5</span>
                      <!-- <span class="price">$18.00</span> -->
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="input-group product-qty">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16">
                                <use xlink:href="#minus"></use>
                              </svg>
                            </button>
                          </span>
                          <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                              <svg width="16" height="16">
                                <use xlink:href="#plus"></use>
                              </svg>
                            </button>
                          </span>
                        </div>
                        <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="product-item">
                      <a href="#" class="btn-wishlist"><svg width="24" height="24">
                          <use xlink:href="#heart"></use>
                        </svg></a>
                      <figure>
                        <a href="index.html" title="Product Title">
                          <img src="images/dummy4.jpg" class="tab-image">
                        </a>
                      </figure>
                      <h3>Sunstar Fresh Melon Juice</h3>
                      <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                          <use xlink:href="#star-solid"></use>
                        </svg> 4.5</span>
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="input-group product-qty">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16">
                                <use xlink:href="#minus"></use>
                              </svg>
                            </button>
                          </span>
                          <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                              <svg width="16" height="16">
                                <use xlink:href="#plus"></use>
                              </svg>
                            </button>
                          </span>
                        </div>
                        <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="product-item">
                      <a href="#" class="btn-wishlist"><svg width="24" height="24">
                          <use xlink:href="#heart"></use>
                        </svg></a>
                      <figure>
                        <a href="index.html" title="Product Title">
                          <img src="images/dummy4.jpg" class="tab-image">
                        </a>
                      </figure>
                      <h3>Sunstar Fresh Melon Juice</h3>
                      <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                          <use xlink:href="#star-solid"></use>
                        </svg> 4.5</span>
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="input-group product-qty">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16">
                                <use xlink:href="#minus"></use>
                              </svg>
                            </button>
                          </span>
                          <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                              <svg width="16" height="16">
                                <use xlink:href="#plus"></use>
                              </svg>
                            </button>
                          </span>
                        </div>
                        <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="product-item">
                      <a href="#" class="btn-wishlist"><svg width="24" height="24">
                          <use xlink:href="#heart"></use>
                        </svg></a>
                      <figure>
                        <a href="index.html" title="Product Title">
                          <img src="images/dummy4.jpg" class="tab-image">
                        </a>
                      </figure>
                      <h3>Sunstar Fresh Melon Juice</h3>
                      <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                          <use xlink:href="#star-solid"></use>
                        </svg> 4.5</span>
                      <!-- <span class="price">$18.00</span> -->
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="input-group product-qty">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16">
                                <use xlink:href="#minus"></use>
                              </svg>
                            </button>
                          </span>
                          <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                              <svg width="16" height="16">
                                <use xlink:href="#plus"></use>
                              </svg>
                            </button>
                          </span>
                        </div>
                        <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="latest-blog" class="py-5">
    <div class="container-fluid">
      <div class="row">
        <div class="section-header d-flex align-items-center justify-content-between my-5">
          <h2 class="section-title">Our Recent Blog</h2>
          <div class="btn-wrap align-right">
            <a href="#" class="d-flex align-items-center nav-link">Read All Articles <svg width="24" height="24">
                <use xlink:href="#arrow-right"></use>
              </svg></a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <article class="post-item card border-0 shadow-sm p-3">
            <div class="image-holder zoom-effect">
              <a href="#">
                <img src="images/blog_images/f3cbb878ef767a9facc6713c9d4495ee.jpg" alt="post" class="card-img-top">
              </a>
            </div>
            <div class="card-body">
              <div class="post-meta d-flex text-uppercase gap-3 my-2 align-items-center">
                <div class="meta-date"><svg width="16" height="16">
                    <use xlink:href="#calendar"></use>
                  </svg>21 Apr 2025</div>
              </div>
              <div class="post-header">
                <h3 class="post-title">
                  <a href="#" class="text-decoration-none">The Ultimate Guide to Corporate Festive Gifting: Diwali, Christmas & More</a>
                </h3>
                <p>The holiday season is a way to thank customers and help businesses cultivate relationships and renew their presence in the brand sphere. The holidays are important for both keeping the business running and actually providing investment into developing a healthier culture for work,....</p>
              </div>
            </div>
          </article>
        </div>
        <div class="col-md-4">
          <article class="post-item card border-0 shadow-sm p-3">
            <div class="image-holder zoom-effect">
              <a href="#">
                <img src="images/blog_images/1dedd705e43ee6576893501d816e3eee.jpg" alt="post" class="card-img-top">
              </a>
            </div>
            <div class="card-body">
              <div class="post-meta d-flex text-uppercase gap-3 my-2 align-items-center">
                <div class="meta-date"><svg width="16" height="16">
                    <use xlink:href="#calendar"></use>
                  </svg>25 Aug 2021</div>
                <div class="meta-categories"><svg width="16" height="16">
                    <use xlink:href="#category"></use>
                  </svg>trending</div>
              </div>
              <div class="post-header">
                <h3 class="post-title">
                  <a href="#" class="text-decoration-none">Corporate Gifts for Remote Teams: Keeping Employees Engaged from Afar</a>
                </h3>
                <p>Owing to its ease and adaptability, telecommuting has totally transformed the corporate culture. But, on the other hand, there are also some demerits, including broken teams, morale issues, and less interaction.....</p>
              </div>
            </div>
          </article>
        </div>
        <div class="col-md-4">
          <article class="post-item card border-0 shadow-sm p-3">
            <div class="image-holder zoom-effect">
              <a href="#">
                <img src="images/blog_images/faf798812e3b5065779a0378ceed00a2.jpg" alt="post" class="card-img-top">
              </a>
            </div>
            <div class="card-body">
              <div class="post-meta d-flex text-uppercase gap-3 my-2 align-items-center">
                <div class="meta-date"><svg width="16" height="16">
                    <use xlink:href="#calendar"></use>
                  </svg>28 Aug 2021</div>
                <div class="meta-categories"><svg width="16" height="16">
                    <use xlink:href="#category"></use>
                  </svg>inspiration</div>
              </div>
              <div class="post-header">
                <h3 class="post-title">
                  <a href="#" class="text-decoration-none">Why Customized Gift Sets Are The Best Choice for Corporate Giveaways?</a>
                </h3>
                <p>If you are trying to boost the morale of your employees and increase productivity, then, giving corporate gifts can be a great idea. These types of gifts are distributed among employees to show appreciation and to new clients to develop new business relations. So,......</p>
              </div>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>
  <footer class="py-5">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-5 col-md-9 col-sm-9">
          <div class="footer-menu">
            <img src="images/logo/OMAIRA LLC_page-0001.jpg" alt="logo" class="img-fluid" style="max-width: 80%;">
            <div class="social-links mt-5">
              <ul class="d-flex list-unstyled gap-2">
                <li>
                  <a href="#" class="btn btn-outline-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M15.12 5.32H17V2.14A26.11 26.11 0 0 0 14.26 2c-2.72 0-4.58 1.66-4.58 4.7v2.62H6.61v3.56h3.07V22h3.68v-9.12h3.06l.46-3.56h-3.52V7.05c0-1.05.28-1.73 1.76-1.73Z" />
                    </svg>
                  </a>
                </li>
                <li>
                  <a href="#" class="btn btn-outline-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M22.991 3.95a1 1 0 0 0-1.51-.86a7.48 7.48 0 0 1-1.874.794a5.152 5.152 0 0 0-3.374-1.242a5.232 5.232 0 0 0-5.223 5.063a11.032 11.032 0 0 1-6.814-3.924a1.012 1.012 0 0 0-.857-.365a.999.999 0 0 0-.785.5a5.276 5.276 0 0 0-.242 4.769l-.002.001a1.041 1.041 0 0 0-.496.89a3.042 3.042 0 0 0 .027.439a5.185 5.185 0 0 0 1.568 3.312a.998.998 0 0 0-.066.77a5.204 5.204 0 0 0 2.362 2.922a7.465 7.465 0 0 1-3.59.448A1 1 0 0 0 1.45 19.3a12.942 12.942 0 0 0 7.01 2.061a12.788 12.788 0 0 0 12.465-9.363a12.822 12.822 0 0 0 .535-3.646l-.001-.2a5.77 5.77 0 0 0 1.532-4.202Zm-3.306 3.212a.995.995 0 0 0-.234.702c.01.165.009.331.009.488a10.824 10.824 0 0 1-.454 3.08a10.685 10.685 0 0 1-10.546 7.93a10.938 10.938 0 0 1-2.55-.301a9.48 9.48 0 0 0 2.942-1.564a1 1 0 0 0-.602-1.786a3.208 3.208 0 0 1-2.214-.935q.224-.042.445-.105a1 1 0 0 0-.08-1.943a3.198 3.198 0 0 1-2.25-1.726a5.3 5.3 0 0 0 .545.046a1.02 1.02 0 0 0 .984-.696a1 1 0 0 0-.4-1.137a3.196 3.196 0 0 1-1.425-2.673c0-.066.002-.133.006-.198a13.014 13.014 0 0 0 8.21 3.48a1.02 1.02 0 0 0 .817-.36a1 1 0 0 0 .206-.867a3.157 3.157 0 0 1-.087-.729a3.23 3.23 0 0 1 3.226-3.226a3.184 3.184 0 0 1 2.345 1.02a.993.993 0 0 0 .921.298a9.27 9.27 0 0 0 1.212-.322a6.681 6.681 0 0 1-1.026 1.524Z" />
                    </svg>
                  </a>
                </li>
                <li>
                  <a href="#" class="btn btn-outline-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M23 9.71a8.5 8.5 0 0 0-.91-4.13a2.92 2.92 0 0 0-1.72-1A78.36 78.36 0 0 0 12 4.27a78.45 78.45 0 0 0-8.34.3a2.87 2.87 0 0 0-1.46.74c-.9.83-1 2.25-1.1 3.45a48.29 48.29 0 0 0 0 6.48a9.55 9.55 0 0 0 .3 2a3.14 3.14 0 0 0 .71 1.36a2.86 2.86 0 0 0 1.49.78a45.18 45.18 0 0 0 6.5.33c3.5.05 6.57 0 10.2-.28a2.88 2.88 0 0 0 1.53-.78a2.49 2.49 0 0 0 .61-1a10.58 10.58 0 0 0 .52-3.4c.04-.56.04-3.94.04-4.54ZM9.74 14.85V8.66l5.92 3.11c-1.66.92-3.85 1.96-5.92 3.08Z" />
                    </svg>
                  </a>
                </li>
                <li>
                  <a href="#" class="btn btn-outline-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M17.34 5.46a1.2 1.2 0 1 0 1.2 1.2a1.2 1.2 0 0 0-1.2-1.2Zm4.6 2.42a7.59 7.59 0 0 0-.46-2.43a4.94 4.94 0 0 0-1.16-1.77a4.7 4.7 0 0 0-1.77-1.15a7.3 7.3 0 0 0-2.43-.47C15.06 2 14.72 2 12 2s-3.06 0-4.12.06a7.3 7.3 0 0 0-2.43.47a4.78 4.78 0 0 0-1.77 1.15a4.7 4.7 0 0 0-1.15 1.77a7.3 7.3 0 0 0-.47 2.43C2 8.94 2 9.28 2 12s0 3.06.06 4.12a7.3 7.3 0 0 0 .47 2.43a4.7 4.7 0 0 0 1.15 1.77a4.78 4.78 0 0 0 1.77 1.15a7.3 7.3 0 0 0 2.43.47C8.94 22 9.28 22 12 22s3.06 0 4.12-.06a7.3 7.3 0 0 0 2.43-.47a4.7 4.7 0 0 0 1.77-1.15a4.85 4.85 0 0 0 1.16-1.77a7.59 7.59 0 0 0 .46-2.43c0-1.06.06-1.4.06-4.12s0-3.06-.06-4.12ZM20.14 16a5.61 5.61 0 0 1-.34 1.86a3.06 3.06 0 0 1-.75 1.15a3.19 3.19 0 0 1-1.15.75a5.61 5.61 0 0 1-1.86.34c-1 .05-1.37.06-4 .06s-3 0-4-.06a5.73 5.73 0 0 1-1.94-.3a3.27 3.27 0 0 1-1.1-.75a3 3 0 0 1-.74-1.15a5.54 5.54 0 0 1-.4-1.9c0-1-.06-1.37-.06-4s0-3 .06-4a5.54 5.54 0 0 1 .35-1.9A3 3 0 0 1 5 5a3.14 3.14 0 0 1 1.1-.8A5.73 5.73 0 0 1 8 3.86c1 0 1.37-.06 4-.06s3 0 4 .06a5.61 5.61 0 0 1 1.86.34a3.06 3.06 0 0 1 1.19.8a3.06 3.06 0 0 1 .75 1.1a5.61 5.61 0 0 1 .34 1.9c.05 1 .06 1.37.06 4s-.01 3-.06 4ZM12 6.87A5.13 5.13 0 1 0 17.14 12A5.12 5.12 0 0 0 12 6.87Zm0 8.46A3.33 3.33 0 1 1 15.33 12A3.33 3.33 0 0 1 12 15.33Z" />
                    </svg>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-2 col-sm-6">
          <div class="footer-menu">
            <h5 class="widget-title">Information</h5>
            <ul class="menu-list list-unstyled">
              <li class="menu-item">
                <a href="about.html" class="nav-link">About us</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link">Terms and Conditions </a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link">Blog</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link">Site Map</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link">FAQ</a>
              </li>
              <li class="menu-item">
                <a href="contact.html" class="nav-link">Contact Us</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link">Orders and Returns</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-2 col-sm-6">
          <div class="footer-menu">
            <h5 class="widget-title">MY ACCOUNT</h5>
            <ul class="menu-list list-unstyled">
              <li class="menu-item">
                <a href="#" class="nav-link">Sign in</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link">View Cart</a>
              </li>
              <li class="menu-item">
                <a href="#" class="nav-link">My Wishlist</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-2 col-sm-6">
          <div class="footer-menu">
            <h5 class="widget-title">CONTACTS</h5>
            <ul class="menu-list list-unstyled">
              <li class="menu-item">337236, U.A.E.</li>
              <li class="menu-item">Whatsapp us now: +971</li>
              <li class="menu-item">Email: <a href="mailto:alomeira@omeirapp.ae?subject=Inquiry&body=Hello, I would like to know more about...">info@</a></li>
            </ul>
          </div>
        </div>


      </div>
    </div>
  </footer>
  <div id="footer-bottom text-center">

    <p style="text-align: center;">© 2025 Print Online. All rights reserved.</p>



  </div>
  <script>
    const userFromPHP = <?= json_encode($user) ?>;
    if (userFromPHP) {
      localStorage.setItem("user", JSON.stringify(userFromPHP));
    } else {
      localStorage.removeItem("user");
    }
  </script>

  <script src="js/jquery-1.11.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="js/plugins.js"></script>
  <script src="js/script.js"></script>
</body>

</html>