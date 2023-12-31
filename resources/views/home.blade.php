<?php
$positiveGreetings = [
    'Wanna break for a while?',
    'Great to see you again!',
    'You bring positive vibes!',
    "Hope you're having an awesome day!",
    'Your presence lights up the room!',
    'Every day is a good day with you!',
    "You're making the world a better place!",
    'Sending you good vibes!',
    'Thanks for being amazing!',
    'Life is brighter with you in it!',
    'Welcome back! Ready for greatness?',
    'Your positivity is contagious!',
    'The day just got better with you here!',
    "You're a star! Shine bright!",
    'Your energy is uplifting!',
    'Cheers to another wonderful day!',
    "You're a ray of sunshine!",
    'Brace yourself for awesomeness!',
];

$randomPositiveGreeting = $positiveGreetings[array_rand($positiveGreetings)];
?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" href="img/icon-mt.png" type="image/png">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/home.css">
</head>
<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar sticky-top navbar-light" style="text-align: center; padding-left: 20px; padding-right: 20px;">
                    <div class="container-fluid">
                        <a class="navbar-brand d-none d-md-block" href="/home"><img src="img/logo.png" alt="logo-tasktify" width="100px"></a>
                        <form class="mx-left my-2 my-md-0 navbar-search" action="/search_task" method="get">
                            <div class="input-group">
                                <input class="bg-light form-control border-0 small" type="text" name="search" placeholder="Search your task here..." style="text-align: left;">
                                <button class="btn btn-primary py-0" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                      <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </li>
                      </ul>
                    </div>
                  </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-0"></div>
                    <span id="clock"></span>
                    <h4 class="mb-4">Hello {{ ucfirst($user->username) }}, {{ lcfirst($randomPositiveGreeting) }}</h4>
                    <canvas id="myChart" class="container-fluid" style="width: 80%; padding: 20px; margin-bottom:40px;"></canvas>
                    <div id="count-date-values">
                        <!-- Data dari Laravel Blade -->
                        @foreach ($countPerDay as $date => $count)
                            <span data-date="{{ $date }}" data-count="{{ $count }}"></span>
                        @endforeach
                    </div>
                    {{-- TASK SUMMARY SECTION --}}
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Not Started</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>{{ $count_not_started }}</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-spinner fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>On Progress</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>{{ $count_on_progress }}</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-tasks fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-info py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Completed</span></div>
                                            <div class="row g-0 align-items-center">
                                                <div class="col-auto">
                                                    <div class="text-dark fw-bold h5 mb-0 me-3"><span>{{ $count_complete }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-check fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Expired</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>{{ $count_expired }}</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-stopwatch fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ADD TASK SECTION --}}
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Add Your Tasks:</h6>
                                </div>
                                <div class="card-body">
                                    <form action="/create_task" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="task_title"><strong>Task Title</strong></label>
                                            <input class="form-control" type="text" id="task_title" placeholder="Enter your task title here..." name="task_title">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="task_desc"><strong>Task Description</strong></label>
                                            <textarea class="form-control" id="task_desc" placeholder="Enter your task description here..." name="task_desc" maxlength="100" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="task_deadline"><strong>Task Deadline</strong></label>
                                            <input class="form-control" type="datetime-local" id="task_deadline" placeholder="Task Deadline" name="task_deadline" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="task_priority"><strong>Task Priority</strong></label>
                                            <select class="form-select" id="task_priority" name="task_priority">
                                                <option value="high">High</option>
                                                <option value="medium">Medium</option>
                                                <option value="low">Low</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="task_status"><strong>Task Status</strong></label>
                                            <select class="form-select" id="task_status" name="task_status">
                                                <option value="not_started">Not Started</option>
                                                <option value="on_progress">On Progress</option>
                                                <option value="completed">Completed</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 d-flex justify-content-end">
                                            <button class="btn btn-primary" type="submit">Add Task</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            @if (isset($search) && isset($result) && $result->count() > 0)
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="text-primary fw-bold m-0">Search Result for <span id="searchQuery">{{ $search ?? '' }}</span></h6>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($result as $r)
                                            <strong>{{ $r->title }}</strong>
                                            <p>Status: {{ $r->status }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            @elseif (isset($search) && (!isset($result) || $result->count() === 0))
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Search Result for <span id="searchQuery">{{ $search ?? '' }}</span></h6>
                                </div>
                                <div class="card-body">
                                    <p style='text-align: center;'>No tasks found for <span id="noResultsQuery">{{ $search ?? '' }}</span>.</p>
                                </div>
                            </div>
                            @endif
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Tasks List</h6>
                                </div>
                                <div class="accordion text-muted" role="tablist" id="accordion-1">
                                    <div class="accordion-item" id="accordion-item-1">
                                        <h2 class="accordion-header" role="tab">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-1" aria-expanded="true" aria-controls="accordion-1 .item-1">
                                                Not Started
                                            </button>
                                        </h2>
                                        <div class="accordion-collapse collapse item-1" role="tabpanel" data-bs-parent="#accordion-1">
                                            <div class="accordion-body">
                                                @if ($count_not_started > 0)
                                                    @foreach ($taskNotStarted as $t)
                                                        <div class="row align-items-center no-gutters justify-content-between body_task">
                                                            <div class="col me-2 head_task">
                                                                <h6 class="mb-0">
                                                                    <span class="priority-dot {{ $t->priority }}"></span>
                                                                    <strong>{{ $t->title }}</strong>
                                                                </h6>
                                                                <span class="text-xs deadline">Deadline: {{ $t->remainingTime() }}</span>
                                                                <div class="desc_task">
                                                                    {{ $t->description }}
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <form action="/task_action" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="task_id" value="{{ $t->id }}">
                                                                    <!-- Tombol "Mark Done" -->
                                                                    <button class="btn btn-primary btn-sm" type="submit" name="action" value="markDone"><i class="fas fa-check"></i></button>
                                                                    <!-- Tombol "Delete Task" -->
                                                                    <button class="btn btn-danger btn-sm" type="submit" name="action" value="deleteTask"><i class="fas fa-trash"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @if($count_not_started > 3)
                                                        <!-- Display pagination links -->
                                                        {{ $taskNotStarted->links() }}
                                                    @endif
                                                @else
                                                    <div class="col me-2 head_task">
                                                        <p style='text-align: center;'>Seems like you do your tasks with great productivity!</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item" id="accordion-item-2">
                                        <h2 class="accordion-header" role="tab">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-2" aria-expanded="false" aria-controls="accordion-1 .item-2">
                                                On Progress
                                            </button>
                                        </h2>
                                        <div class="accordion-collapse collapse item-2" role="tabpanel" data-bs-parent="#accordion-1">
                                            <div class="accordion-body">
                                                @if ($count_on_progress > 0)
                                                    @foreach ($taskOnProgress as $t)
                                                        <div class="row align-items-center no-gutters justify-content-between body_task">
                                                            <div class="col me-2 head_task">
                                                                <h6 class="mb-0">
                                                                    <span class="priority-dot {{ $t->priority }}"></span>
                                                                    <strong>{{ $t->title }}</strong>
                                                                </h6>
                                                                <span class="text-xs deadline">Deadline: {{ $t->remainingTime() }}</span>
                                                                <div class="desc_task">
                                                                    {{ $t->description }}
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <form action="/task_action" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="task_id" value="{{ $t->id }}">
                                                                    <!-- Tombol "Mark Done" -->
                                                                    <button class="btn btn-primary btn-sm" type="submit" name="action" value="markDone"><i class="fas fa-check"></i></button>
                                                                    <!-- Tombol "Delete Task" -->
                                                                    <button class="btn btn-danger btn-sm" type="submit" name="action" value="deleteTask"><i class="fas fa-trash"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @if($count_on_progress > 3)
                                                        <!-- Display pagination links -->
                                                        {{ $taskOnProgress->links() }}
                                                    @endif
                                                @else
                                                    <div class="col me-2 head_task">
                                                        <p style='text-align: center;'>Wow, you've completed all the tasks in progress!</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item" id="accordion-item-3">
                                        <h2 class="accordion-header" role="tab">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-3" aria-expanded="false" aria-controls="accordion-1 .item-3">
                                                Completed
                                            </button>
                                        </h2>
                                        <div class="accordion-collapse collapse item-3" role="tabpanel" data-bs-parent="#accordion-1">
                                            <div class="accordion-body">
                                                @if ($count_complete > 0)
                                                    @foreach ($taskCompleted as $t)
                                                        <div class="row align-items-center no-gutters justify-content-between body_task">
                                                            <div class="col me-2 head_task">
                                                                <h6 class="mb-0">
                                                                    <span class="priority-dot {{ $t->priority }}"></span>
                                                                    <strong>{{ $t->title }}</strong>
                                                                </h6>
                                                                <span class="text-xs deadline">Deadline: {{ $t->remainingTime() }}</span>
                                                                <div class="desc_task">
                                                                    {{ $t->description }}
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <form action="/task_action" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="task_id" value="{{ $t->id }}">
                                                                    <!-- Tombol "Delete Task" -->
                                                                    <button class="btn btn-danger btn-sm" type="submit" name="action" value="deleteTask"><i class="fas fa-trash"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @if($count_complete > 3)
                                                        <!-- Display pagination links -->
                                                        {{ $taskCompleted->links() }}
                                                    @endif
                                                @else
                                                    <div class="col me-2 head_task">
                                                        <p style='text-align: center;'>Congratulations! You've successfully completed all your tasks.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item" id="accordion-item-4">
                                        <h2 class="accordion-header" role="tab">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-4" aria-expanded="false" aria-controls="accordion-1 .item-4">
                                                Expired
                                            </button>
                                        </h2>
                                        <div class="accordion-collapse collapse item-4" role="tabpanel" data-bs-parent="#accordion-1">
                                            <div class="accordion-body">
                                                @if ($count_expired > 0)
                                                    @foreach ($taskExpired as $t)
                                                        <div class="row align-items-center no-gutters justify-content-between body_task">
                                                            <div class="col me-2 head_task">
                                                                <h6 class="mb-0">
                                                                    <span class="priority-dot {{ $t->priority }}"></span>
                                                                    <strong>{{ $t->title }}</strong>
                                                                </h6>
                                                                <span class="text-xs deadline">Deadline: {{ $t->deadline }}</span>
                                                                <div class="desc_task">
                                                                    {{ $t->description }}
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <form action="/task_action" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="task_id" value="{{ $t->id }}">
                                                                    <!-- Tombol "Delete Task" -->
                                                                    <button class="btn btn-danger btn-sm" type="submit" name="action" value="deleteTask" id="deleteTaskButton"><i class="fas fa-trash"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @if($count_expired > 3)
                                                        <!-- Display pagination links -->
                                                        {{ $taskExpired->links() }}
                                                    @endif
                                                @else
                                                    <div class="col me-2 head_task">
                                                        <p style='text-align: center;'>Great Job! No tasks have expired.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Tasktify 2023</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/theme.js"></script>
    <script src="js/script.js"></script>
</body>

</html>