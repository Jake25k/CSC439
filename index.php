<?php
$pageTitle = 'Best Books';
include('includes/header.php');
include('functions.php');

$db_con = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
$numUsers = getNumUsers();
$numBooks = getNumBooks();
?>


    <div class="container text-center">
      <div class="row">
        <div class="col-md-7 col-sm-12  text-white">
          <h6>BestBooks.com</h6>
          <h1>ADVENTURE STARTS HERE</h1>
          <p>
            BestBooks.com offers the best books from some of the greatest authors around the world.
          </p>
          <a class="btn btn-light px-5 py-2 primary-btn" href="login.php">
            Subscribe today starting at $5.99
          </a>
        </div>
        <div class="col-md-5 col-sm-12  h-25">
          <img src="./assets/header-img.png" alt="Book" />
        </div>
      </div>
    </div>
  </header>
  <main>
    <section class="section-1">
      <div class="container text-center">
        <div class="row">
          <div class="col-md-6 col-12">
            <div class="pray">
              <img src="./assets/pexels-photo-1904769.jpeg" alt="Pray" class="" />
            </div>
          </div>
          <div class="col-md-6 col-12">
            <div class="panel text-left">
              <h1>Who are BestBooks.com?</h1>
              <p class="pt-4">
                BestBooks.com was founded by a group of students who wanted to make a difference in the world. Their passion for reading and
                 adventure pushed them to make a service that consumers could rely on. Whether you are looking for the hottest new novel or an
                 old classic, BestBooks.com has what you are looking for at a price that won't break the bank.
              </p>
              <p>
                Starting off at the low price of $5.99 you could have access to our premium library of fantastic literature. For years we have provided
                some of the best customer service out there. Not fully satisfied with your purchase? No need to head back out to your local bookstore to return it.
                BestBooks.com digitalizes the whole process and allows you to check it back in virtually. Thats right - no more hassle of driving out to the store
                and most importantly no more late fees.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section-2 container-fluid p-0">
      <div class="cover">
        <div class="overlay"></div>
        <div class="content text-center">
          <h1>Some Features That Made Us Unique</h1>
          <p>
            Service by the Numbers
          </p>
        </div>
      </div>
      <div class="container-fluid text-center">
        <div class="numbers d-flex flex-md-row flex-wrap justify-content-center">
          <div class="rect">
            <h1><?php echo $numUsers; ?></h1>
            <p>Subscribed Patrons</p>
          </div>
          <div class="rect">
            <h1><?php echo $numBooks; ?></h1>
            <p>Books in our Library</p>
          </div>
        </div>
      </div>


      <div class="purchase text-center">
        <h1>Purchase What Works Best For You</h1>
        <p>
          Three different price points. Always a subscription that works best for you.
        </p>
        <div class="cards">
          <div class="d-flex flex-row justify-content-center flex-wrap">
            <div class="card">
              <div class="card-body">
                <div class="title">
                  <h5 class="card-title">Basic Model</h5>
                </div>
                <p class="card-text">
                  Unlimited access to our timeless library.
                </p>
                <div class="pricing">
                  <h1>$5.99</h1>
                  <a href="#" class="btn btn-dark px-5 py-2 primary-btn mb-5">Purchase Now</a>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="title">
                  <h5 class="card-title">Premium Model</h5>
                </div>
                <p class="card-text">
                  Perfect for students. Enjoy access to our premium selection of student textbooks for all subjects.
                </p>
                <div class="pricing">
                  <h1 style="font-size:8vmin;">$40.99</h1>
                  <a href="#" class="btn btn-dark px-5 py-2 primary-btn mb-5">Purchase Now</a>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="title">
                  <h5 class="card-title">Deluxe Model</h5>
                </div>
                <p class="card-text">
                  Unlimited access to our library and access to a select bunch of America's best newspapers.
                  Including:
                  New York Times,
                  Washington Post,
                  etc.
                </p>
                <div class="pricing">
                  <h1 style="font-size:8vmin;">$69.99</h1>
                  <a href="#" class="btn btn-dark px-5 py-2 primary-btn mb-5">Purchase Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section-3 container-fluid p-0 text-center">
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <h1>Download Our App for all Platform</h1>
          <p>
            Take our library with you wherever you go. No more squeezing novels into your purse or luggage. We go were you need us.
          </p>
        </div>
      </div>
      <div class="platform row">
        <div class="col-md-6 col-sm-12 text-right">
          <div class="desktop shadow-lg">
            <div class="d-flex flex-row justify-content-center">
              <i class="fas fa-desktop fa-3x py-2 pr-3"></i>
              <div class="text text-left">
                <h3 class="pt-1 m-0">Desktop</h3>
                <p class="p-0 m-0">On website</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-12 text-left">
          <div class="desktop shadow-lg">
            <div class="d-flex flex-row justify-content-center">
              <i class="fas fa-mobile-alt fa-3x py-2 pr-3"></i>
              <div class="text text-left">
                <h3 class="pt-1 m-0">On Mobile</h3>
                <p class="p-0 m-0">On Play Store</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 4 -->
    <section class="section-4">
      <div class="container text-center">
        <h1 class="text-dark">What our Reader's Say About Us</h1>
      </div>
      <div class="team row ">
        <div class="col-md-4 col-12 text-center">
            <div class="card mr-2 d-inline-block shadow-lg">
                <div class="card-img-top">
                  <img src="./assets/UI-face-3.jpg" class="img-fluid border-radius p-4" alt="">
                </div>
                <div class="card-body">
                  <h3 class="card-title">Blalock Jolene</h3>
                  <p class="card-text">
                    I couldn't believe they had all the books I needed for my last semester! At such an incredible price, I couldn't say no. Thanks BestBooks!
                  </p>
                  <a href="#" class="text-secondary text-decoration-none">Highland Heights, KY</a>
                  <p class="text-black-50">Northern Kentucky University Student</p>
                </div>
              </div>
        </div>
        <div class="col-md-4 col-12">
            <div id="carouselExampleControls" class="carousel slide " data-ride="carousel">
                <div class="carousel-inner text-center">
                  <div class="carousel-item active">
                    <div class="card mr-2 d-inline-block shadow">
                      <div class="card-img-top">
                        <img src="./assets/UI-face-1.jpg" class="img-fluid rounded-circle w-50 p-4" alt="">
                      </div>
                      <div class="card-body">
                        <h3 class="card-title">Allen Agnes</h3>
                        <p class="card-text">
                          I'm an avid reader and enjoy a wide variety of books. It will take me ages to get through BestBooks.com selection.
                        </p>
                        <a href="#" class="text-secondary text-decoration-none">New York, New York</a>
                        <p class="text-black-50">Stock Broker</p>
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="card  d-inline-block mr-2 shadow">
                      <div class="card-img-top">
                        <img src="./assets/UI-face-2.jpg" class="img-fluid rounded-circle w-50 p-4" alt="">
                      </div>
                      <div class="card-body">
                        <h3 class="card-title">Amiel Barbara</h3>
                        <p class="card-text">
                          I love to keep up with whats going on in the news. With The Premium Model, I'm able to stay up to date with all my favorite newspapers.
                        </p>
                        <a href="#" class="text-secondary text-decoration-none">Houston, Texas</a>
                        <p class="text-black-50">Astronaut</p>
                      </div>
                    </div>
                  </div>
              </div>
        </div>
        </div>
        <div class="col-md-4 col-12 text-center">
            <div class="card mr-2 d-inline-block shadow-lg">
                <div class="card-img-top">
                  <img src="./assets/UI-face-4.jpg" class="img-fluid border-radius p-4" alt="">
                </div>
                <div class="card-body">
                  <h3 class="card-title">Olivia Louis</h3>
                  <p class="card-text">
                    I can't recommend this website enough! I've been subscribed for years. The customer service was great, and the selection is premium.
                  </p>
                  <a href="#" class="text-secondary text-decoration-none">Bowling Green, KY</a>
                  <p class="text-black-50">Coal Miner</p>
                </div>
              </div>
        </div>
      </div>
    </section>
  </main>


<?php
include('includes/footer.php');
?>
