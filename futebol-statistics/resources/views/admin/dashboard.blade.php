@extends('layouts.back-layout')

@section('content')

       
  <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Teams</p>
                                <h6 class="mb-0">{{$totalTeams}} Teams</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Matches</p>
                                <h6 class="mb-0">{{$totalMatches}} Matches</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Players</p>
                                <h6 class="mb-0">{{$totalPerson}} Players</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Seasons</p>
                                <h6 class="mb-0">{{$totalSeason}} Seasons</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <!-- First Column for Competition Type Chart -->
                    <div class="col-sm-12 col-md-6">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Type for Competition</h6>
                            </div>
                            <canvas id="competition-chart" width="400" height="200"></canvas>
                        </div>
                    </div>
                    
                    <!-- Second Column for Teams Count Chart -->
                    <div class="col-sm-12 col-md-6">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Teams for Competition</h6>
                            </div>
                            <canvas id="teams-chart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var competitions = @json($competitions);
                    
                    // Count the number of competitions for each type
                    var typeCounts = {};
                    competitions.forEach(function(competition) {
                        var type = competition.type;
                        if (typeCounts[type]) {
                            typeCounts[type] += 1;
                        } else {
                            typeCounts[type] = 1;
                        }
                    });
                
                    var competitionTypes = Object.keys(typeCounts);
                    var competitionCounts = Object.values(typeCounts);
                    
                    var ctx1 = document.getElementById('competition-chart').getContext('2d');
                    var ctx2 = document.getElementById('teams-chart').getContext('2d');
                
                    // Define custom colors for each type
                    var leagueColor = 'rgba(255, 205, 86, 0.6)'; 
                    var cupColor = 'rgba(255, 215, 0, 0.6)';     // Blue color for CUP
                    
                    var teamsCompetitionChart = new Chart(ctx1, {
                        type: 'pie',
                        data: {
                            labels: competitionTypes,
                            datasets: [{
                                label: 'Number of Competitions',
                                data: competitionCounts,
                                backgroundColor: competitionTypes.map(function(type) {
                                    return type === 'LEAGUE' ? leagueColor : cupColor;
                                }),
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    stepSize: 1 // Ensure step size is 1 for whole numbers
                                }
                            }
                        }
                    });
        
                    var competitionNames = competitions.map(function (competition) {
                        return competition.name;
                    });
        
                    var teamsCount = competitions.map(function (competition) {
                        return competition.teams_count;
                    });
        
                    var teamsChart = new Chart(ctx2, {
                        type: 'pie',
                        data: {
                            labels: competitionNames,
                            datasets: [{
                                label: 'Number of Teams',
                                data: teamsCount,
                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    stepSize: 1
                                }
                            }
                        }
                    });
                });
            </script>
                    
                    
            <!-- Sales Chart End -->


            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-2">Messages Table</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $message)
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#messageModal{{ $message->id }}" data-message-id="{{ $message->id }}">
                                            {{ $message->id }}
                                        </button>
                                    </td>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->subject }}</td>
                                    <td>{{ $message->message }}</td>
                                    <td>
                                        @if ($message->is_read)
                                            <span id="badge_{{ $message->id }}" class="badge bg-success">Read</span>
                                        @else
                                            <span id="badge_{{ $message->id }}" class="badge bg-warning text-dark">Unread</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            @foreach ($messages as $message)
            <!-- Modal -->
            <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $message->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark text-light">
                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="messageModalLabel{{ $message->id }}">Message Details</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>ID:</strong> {{ $message->id }}</p>
                            <p><strong>Name:</strong> {{ $message->name }}</p>
                            <p><strong>Email:</strong> {{ $message->email }}</p>
                            <p><strong>Subject:</strong> {{ $message->subject }}</p>
                            <p><strong>Message:</strong></p>
                            <p>{{ $message->message }}</p>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            

            <script>
                $(document).ready(function() {
                    $('#messageModal{{ $message->id }}').on('show.bs.modal', function(event) {
                        var button = $(event.relatedTarget); // Button that triggered the modal
                        var messageId = button.data('message-id'); // Extract info from data-* attributes
                        markMessageAsRead(messageId);
                    });
            
                    function markMessageAsRead(messageId) {
                        $.ajax({
                            type: 'GET',
                            url: '/mark-as-read/' + messageId, // Update the URL according to your route
                            success: function(response) {
                                console.log(response); // Log success message
                                // Update UI to reflect read status
                                var badge = $('#badge_' + messageId);
                                if (badge.length) {
                                    badge.removeClass('bg-warning text-dark').addClass('bg-success').text('Read');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText); // Log error message
                            }
                        });
                    }
                });
            </script>


<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- First Column for Competition Type Chart -->
        <div class="col-sm-12 col-md-6">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Matches by Competition</h6>
                </div>
                <canvas id="matches-chart" width="400" height="200"></canvas>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var matches = @json($matches);
                var competitions = @json($competitions);
        
                // Create a map of competition IDs to their names
                var competitionNames = {};
                competitions.forEach(function(competition) {
                    competitionNames[competition.competitions_id] = competition.name;
                });
        
                // Count the number of matches for each competition
                var matchesCounts = {};
                matches.forEach(function(match) {
                    var competitionId = match.competition_id;
                    var competitionName = competitionNames[competitionId];
                    if (!matchesCounts[competitionName]) {
                        matchesCounts[competitionName] = 1;
                    } else {
                        matchesCounts[competitionName] += 1;
                    }
                });
        
                var competitionNames = Object.keys(matchesCounts);
                var matchesCount = Object.values(matchesCounts);
        
                var ctx = document.getElementById('matches-chart').getContext('2d');
        
                var matchesChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: competitionNames,
                        datasets: [{
                            label: 'Number of Matches',
                            data: matchesCount,
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                stepSize: 1
                            }
                        }
                    }
                });
            });
        </script>
       
        
        
        
        <!-- Second Column for Teams Count Chart -->
        <div class="col-sm-12 col-md-6">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Seasons by Competitions</h6>
                </div>
                <canvas id="seasons-competitions-chart" width="400" height="200"></canvas>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var competitions = @json($competitions);
                var competitionNames = competitions.map(function (competition) {
                    return competition.name;
                });
        
                var seasonsCount = competitions.map(function (competition) {
                    return competition.seasons_count;
                });
                var ctx = document.getElementById('seasons-competitions-chart').getContext('2d');
                var seasonsChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: competitionNames,
                        datasets: [{
                            label: 'Number of Seasons',
                            data: seasonsCount,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                stepSize: 1
                            }
                        }
                    }
                });
            });
        </script>
        


       
          

@endsection
