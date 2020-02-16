
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="content.css">

    <!------ Include the above in your HEAD tag ---------->
</head>

<body style="background-color: f0f0f0">
    <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark homeheader">
        <a class="navbar-brand" href="index.php">
            <img class="navbar-brand" src="images/logo.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="coures.html">
                        Courses
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">

                        Groups
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="#">

                        Grades
                    </a>
                </li>


            </ul>
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa fa-bell">
                            <span class="badge badge-info">11</span>
                        </i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa fa-search">
                            <span class="badge badge-success"></span>
                        </i>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa fa-envelope">
                            <span class="badge badge-info">2</span>
                        </i>
                    </a>
                </li>
                <li>
                    <div class="dropdown mydrop">
                        <button type="button" class="btn btn-primary dropdown-toggle mydropbutton" data-toggle="dropdown">
                            <img src="http://www.bobmazzo.com/wp-content/uploads/2009/07/bobmazzoCD.jpg" width="30" height="30">

                            <?php
                            $user_email;
                            ?>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="Profile.html">Your Profile</a>
                            <a class="dropdown-item" href="#">Future Academy</a>
                            <a class="dropdown-item" href="#">Settings</a>
                            <a class="dropdown-item" href="#"><i class="fa fa-sign-out"></i>Log out</a>
                        </div>
                    </div>
                </li>

            </ul>


        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card -row my-5">

                    <div class="card-body">
                        <h>Posts</h>
                        <hr class="my-2">
                        <div class="raw">
                            <div>
                                <a href="#"><img src="http://www.bobmazzo.com/wp-content/uploads/2009/07/bobmazzoCD.jpg" width="30" height="30"> </a>
                                <a href="#">anas Hassan</a>
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                <a href="#">csc413 mobil programming fall:2019</a>
                            </div>
                            <div class="diveditfirst">
                                Ghost Stories was a U.S. pulp magazine that published 64 issues between 1926 and 1932. It was one of the earliest competitors to Weird Tales, the first magazine to specialize in the fantasy and occult fiction genre. Ghost Stories was a companion magazine to True Story and True Detective Stories, and focused almost entirely on stories about ghosts, many of which were written by staff writers but presented under pseudonyms as true confessions. These were often accompanied by faked photographs to make the stories appear more believable. Ghost Stories also ran original and reprinted contributions, including works by Robert E. Howard, Carl Jacobi, and Frank Belknap Long. Among the reprints were Agatha Christie's "The Last Seance" (under the title "The Woman Who Stole a Ghost"), several stories by H. G. Wells, and Charles Dickens's "The Signal-Man". The magazine was initially successful, but had begun to lose readers by 1930, and ceased publication at the start of 1932.


                                <hr class="my-2">
                                <div class="row bootstrap snippets">
                                    <div class="col-12 col-md-8">
                                        <div class="comment-wrapper">
                                            <div class="panel panel-info">

                                                <div class="panel-body">
                                                    <textarea class="form-control" placeholder="write a comment..." rows="3"></textarea>

                                                    <button type="button" class="btn btn-info pull-right">Post</button>
                                                    <div class="clearfix"></div>
                                                    <hr>
                                                    <ul class="media-list">
                                                        <li class="media">
                                                            <a href="#" class="pull-left">
                                                                <img src="http://www.bobmazzo.com/wp-content/uploads/2009/07/bobmazzoCD.jpg" width="30" height="30">
                                                            </a>
                                                            <div class="media-body">
                                                                <span class="text-muted pull-right">
                                                                    <small class="text-muted">30 min ago</small>
                                                                </span>
                                                                <strong class="text-success">@anshassan</strong>
                                                                <p>
                                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                    Lorem ipsum dolor sit amet, <a href="#">#consecteturadipiscing </a>.
                                                                </p>
                                                            </div>
                                                        </li>


                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr class="my-2">
                        <div class="raw">
                            <div>
                                <a href="#"><img src="http://www.bobmazzo.com/wp-content/uploads/2009/07/bobmazzoCD.jpg" width="30" height="30"> </a>
                                <a href="#">anas Hassan</a>
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                <a href="#">csc413 mobil programming fall:2019</a>
                            </div>
                            <div class="diveditfirst">
                                Ghost Stories was a U.S. pulp magazine that published 64 issues between 1926 and 1932. It was one of the earliest competitors to Weird Tales, the first magazine to specialize in the fantasy and occult fiction genre. Ghost Stories was a companion magazine to True Story and True Detective Stories, and focused almost entirely on stories about ghosts, many of which were written by staff writers but presented under pseudonyms as true confessions. These were often accompanied by faked photographs to make the stories appear more believable. Ghost Stories also ran original and reprinted contributions, including works by Robert E. Howard, Carl Jacobi, and Frank Belknap Long. Among the reprints were Agatha Christie's "The Last Seance" (under the title "The Woman Who Stole a Ghost"), several stories by H. G. Wells, and Charles Dickens's "The Signal-Man". The magazine was initially successful, but had begun to lose readers by 1930, and ceased publication at the start of 1932.


                                <hr class="my-2">
                                <div class="row bootstrap snippets">
                                    <div class="col-12 col-md-8">
                                        <div class="comment-wrapper">
                                            <div class="panel panel-info">

                                                <div class="panel-body">
                                                    <textarea class="form-control" placeholder="write a comment..." rows="3"></textarea>

                                                    <button type="button" class="btn btn-info pull-right">Post</button>
                                                    <div class="clearfix"></div>
                                                    <hr>
                                                    <ul class="media-list">
                                                        <li class="media">
                                                            <a href="#" class="pull-left">
                                                                <img src="http://www.bobmazzo.com/wp-content/uploads/2009/07/bobmazzoCD.jpg" width="30" height="30">
                                                            </a>
                                                            <div class="media-body">
                                                                <span class="text-muted pull-right">
                                                                    <small class="text-muted">30 min ago</small>
                                                                </span>
                                                                <strong class="text-success">@anshassan</strong>
                                                                <p>
                                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                    Lorem ipsum dolor sit amet, <a href="#">#consecteturadipiscing </a>.
                                                                </p>
                                                            </div>
                                                        </li>


                                                    </ul>
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

            <div class="col-6 col-md-4">
                <div class="card -row my-5">
                    <div class="card-body">
                        <h>overdue</h>
                        <hr class="my-2">
                        <div class="raw">
                            <div class="diveditsecond">
                                sunday.1 dec 2019
                                <hr class="my-1">
                                <img src="http://www.bobmazzo.com/wp-content/uploads/2009/07/bobmazzoCD.jpg" width="20" height="20">
                                <a href="#">Assignment 1</a>
                                11:59pm


                            </div>
                            <hr style="background-color: blue " class="my-3 ">
                            <h>upcoming</h>
                            <hr class="my-2">
                            <div class="diveditsecond">
                                No upcoming assignments or events


                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>
    <!-- Footer -->
    <footer class="page-footer font-small footerstyle">
        <hr>
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">©Future Marker 2020 Copyright:

        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

</body></html>
