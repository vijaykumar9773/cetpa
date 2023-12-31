<div class="container-xxl position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="" class="navbar-brand p-0">
            <a href="{{url('')}}"><h1 class="m-0">DGital</h1></a>
            <!-- <img src="img/logo.png" alt="Logo"> -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="{{url('')}}" class="nav-item nav-link active">Home</a>
                <a href="{{url('about')}}" class="nav-item nav-link">About</a>
                <a href="{{url('service')}}" class="nav-item nav-link">Service</a>
                <a href="{{url('project')}}" class="nav-item nav-link">Project</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{url('team')}}" class="dropdown-item">Our Team</a>
                        <a href="{{url('testimonial')}}" class="dropdown-item">Testimonial</a>
                        <a href="{{url('404')}}" class="dropdown-item">404 Page</a>
                    </div>
                </div>
                <a href="{{url('contact')}}" class="nav-item nav-link">Contact</a>
            </div>
            <a href="#" class="btn rounded-pill py-2 px-4 ms-3 d-none d-lg-block">Get Started</a>
        </div>
    </nav>