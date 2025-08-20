
<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">My Support Tickets</h5>
                    <a href="<?php echo $base_url.'index.php?action=dashboard&page=agent_support';?>" class="btn btn-primary btn-sm">
                        <i class="ti ti-plus me-1"></i>New Ticket
                    </a>
                </div>
            </div>
            <div class="card-body content">
                <?php if(isset($_GET['status']) && $_GET['status']=='1'){?>
                <div class="alert alert-success">Your reply has been sent successfully.</div>
                <?php } elseif(isset($_GET['status']) && $_GET['status']=='0'){?>
                <div class="alert alert-danger">Failed to send reply. Please try again.</div>
                <?php }?>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Ticket ID</th>
                                <th>Subject</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Last Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $agent_id = $_SESSION['aid'];
                            $tickets = $admin->get_support_tickets_by_agent($agent_id);
                            
                            if($tickets && count($tickets) > 0) {
                                foreach($tickets as $ticket) {
                                    $status_text = '';
                                    $status_class = '';
                                    
                                    switch($ticket['status']) {
                                        case '0':
                                            $status_text = 'Open';
                                            $status_class = 'badge bg-warning';
                                            break;
                                        case '1':
                                            $status_text = 'In Progress';
                                            $status_class = 'badge bg-info';
                                            break;
                                        case '2':
                                            $status_text = 'Resolved';
                                            $status_class = 'badge bg-success';
                                            break;
                                        case '3':
                                            $status_text = 'Closed';
                                            $status_class = 'badge bg-secondary';
                                            break;
                                        default:
                                            $status_text = 'Unknown';
                                            $status_class = 'badge bg-secondary';
                                    }
                            ?>
                            <tr>
                                <td><strong>#<?php echo $ticket['id']; ?></strong></td>
                                <td><?php echo htmlspecialchars($ticket['name']); ?></td>
                                <td><span class="badge bg-primary"><?php echo htmlspecialchars($ticket['category']); ?></span></td>
                                <td><span class="<?php echo $status_class; ?>"><?php echo $status_text; ?></span></td>
                                <td><?php echo date('d-m-Y H:i', strtotime($ticket['date_time'])); ?></td>
                                <td><?php echo date('d-m-Y H:i', strtotime($ticket['last_modified'])); ?></td>
                                <td>
                                                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#ticketModal<?php echo $ticket['id']; ?>">
                                                <i class="ti ti-eye"></i> View & Reply
                                            </button>
                                </td>
                            </tr>
                            
                            <!-- Modal for ticket details -->
                            <div class="modal fade" id="ticketModal<?php echo $ticket['id']; ?>" tabindex="-1" aria-labelledby="ticketModalLabel<?php echo $ticket['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ticketModalLabel<?php echo $ticket['id']; ?>">
                                                Ticket #<?php echo $ticket['id']; ?> - <?php echo htmlspecialchars($ticket['name']); ?>
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                                                                        <div class="modal-body">
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <strong>Category:</strong> <?php echo htmlspecialchars($ticket['category']); ?>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Status:</strong> <span class="<?php echo $status_class; ?>"><?php echo $status_text; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <strong>Created:</strong> <?php echo date('d-m-Y H:i', strtotime($ticket['date_time'])); ?>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Last Updated:</strong> <?php echo date('d-m-Y H:i', strtotime($ticket['last_modified'])); ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Conversation History -->
                                                    <?php 
                                                    $ticket_id = $ticket['id'];
                                                    $responses = $admin->get_support_ticket_responses($ticket_id);
                                                    
                                                    if($responses && count($responses) > 0) {
                                                        echo '<hr><h6 class="mb-3">Conversation History</h6>';
                                                        echo '<div class="list-group mb-3" style="max-height: 300px; overflow:auto;">';
                                                        foreach($responses as $response) {
                                                            // Check if commentby matches current agent ID or if it's an admin
                                                            $current_agent_id = $_SESSION['aid'];
                                                            $isAdmin = (isset($response['commentby']) && $response['commentby'] !== '' && $response['commentby'] !== '0' && $response['commentby'] != $current_agent_id);
                                                            $who = $isAdmin ? 'Admin' : 'Agent';
                                                            $badge = $isAdmin ? 'bg-secondary' : 'bg-success';
                                                            $cardClass = $isAdmin ? 'border-secondary' : 'border-success';
                                                            $commentText = isset($response['comment']) ? $response['comment'] : '';
                                                            
                                                            echo '<div class="card mb-2 '.$cardClass.'">';
                                                            echo '<div class="card-body p-3">';
                                                            echo '<div class="d-flex justify-content-between mb-2">';
                                                            echo '<span class="badge '.$badge.'">'.$who.'</span>';
                                                            echo '<small class="text-muted">ID: '.$response['id'].'</small>';
                                                            echo '</div>';
                                                            echo '<div class="mt-2">'.nl2br(htmlspecialchars($commentText)).'</div>';
                                                            echo '</div>';
                                                            echo '</div>';
                                                        }
                                                        echo '</div>';
                                                    } else {
                                                        echo '<hr><div class="alert alert-info">No responses yet.</div>';
                                                    }
                                                    ?>
                                                    
                                                    <!-- Agent Reply Form -->
                                                    <hr>
                                                    <h6>Send Reply</h6>
                                                    <form method="post" action="<?php echo $base_url.'index.php?action=agent&query=save_agent_response';?>">
                                                        <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
                                                        <div class="mb-3">
                                                            <textarea class="form-control" name="response" rows="3" placeholder="Enter your reply..." required></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            <i class="ti ti-send me-1"></i>Send Reply
                                                        </button>
                                                    </form>
                                                </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php 
                                }
                            } else {
                                echo '<tr><td colspan="7" class="text-center">No tickets found.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
      </div> 