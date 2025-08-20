<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
                <h5 class="card-title">Support Tickets Management</h5>
            </div>
            <div class="card-body content">
                <?php if(isset($_GET['status']) && $_GET['status']=='1'){?>
                <div class="alert alert-success">Response has been sent successfully.</div>
                <?php } elseif(isset($_GET['status']) && $_GET['status']=='0'){?>
                <div class="alert alert-danger">Failed to send response. Please try again.</div>
                <?php }?>
                
                <!-- Tabs -->
                <ul class="nav nav-tabs" id="supportTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="agent-tab" data-bs-toggle="tab" data-bs-target="#agent" type="button" role="tab" aria-controls="agent" aria-selected="true">
                            Agent Tickets
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="customer-tab" data-bs-toggle="tab" data-bs-target="#customer" type="button" role="tab" aria-controls="customer" aria-selected="false">
                            Customer Tickets
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="supportTabsContent">
                    
                    <!-- Agent Tickets Tab -->
                    <div class="tab-pane fade show active" id="agent" role="tabpanel" aria-labelledby="agent-tab">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6>Agent Support Tickets</h6>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="filterTickets('all')">All</button>
                                <button type="button" class="btn btn-outline-warning btn-sm" onclick="filterTickets('open')">Open</button>
                                <button type="button" class="btn btn-outline-info btn-sm" onclick="filterTickets('progress')">In Progress</button>
                                <button type="button" class="btn btn-outline-success btn-sm" onclick="filterTickets('resolved')">Resolved</button>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="agentTicketsTable">
                                <thead>
                                    <tr>
                                        <th>Ticket ID</th>
                                        <th>Subject</th>
                                        <th>Agent</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Last Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    // Debug: Show the query and results
                                    $query = "SELECT st.*, a.fname, a.lname, a.bname 
                                             FROM support_tickets st 
                                             LEFT JOIN agent a ON st.aid = a.id 
                                             ORDER BY st.date_time DESC";
                                    $tickets = $db_handle->runBaseQuery($query);
                                    
                                    // Debug: Show query results
                                    echo "<!-- Debug: Query: " . $query . " -->";
                                    echo "<!-- Debug: Tickets found: " . ($tickets ? count($tickets) : 'null/false') . " -->";
                                    
                                    // Debug: Check all tickets without filter
                                    $all_query = "SELECT st.*, a.fname, a.lname, a.bname 
                                                 FROM support_tickets st 
                                                 LEFT JOIN agent a ON st.aid = a.id 
                                                 ORDER BY st.date_time DESC";
                                    $all_tickets = $db_handle->runBaseQuery($all_query);
                                    echo "<!-- Debug: All tickets without filter: " . ($all_tickets ? count($all_tickets) : 'null/false') . " -->";
                                    
                                    if($tickets && count($tickets) > 0) {
                                        foreach($tickets as $ticket) {
                                            $status_text = '';
                                            $status_class = '';
                                            $status_value = $ticket['status'];
                                            
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
                                            
                                            $agent_name = $ticket['fname'] . ' ' . $ticket['lname'];
                                            if($ticket['bname']) {
                                                $agent_name .= ' (' . $ticket['bname'] . ')';
                                            }
                                    ?>
                                    <tr data-status="<?php echo $status_value; ?>">
                                        <td><strong>#<?php echo $ticket['id']; ?></strong></td>
                                        <td><?php echo htmlspecialchars($ticket['name']); ?></td>
                                        <td><?php echo htmlspecialchars($agent_name); ?></td>
                                        <td><span class="badge bg-primary"><?php echo htmlspecialchars($ticket['category']); ?></span></td>
                                        <td><span class="<?php echo $status_class; ?>"><?php echo $status_text; ?></span></td>
                                        <td><?php echo date('d-m-Y H:i', strtotime($ticket['date_time'])); ?></td>
                                        <td><?php echo date('d-m-Y H:i', strtotime($ticket['last_modified'])); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#ticketModal<?php echo $ticket['id']; ?>">
                                                <i class="ti ti-eye"></i> View
                                            </button>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#statusModal<?php echo $ticket['id']; ?>">
                                                <i class="ti ti-edit"></i> Update Status
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
                                                            <strong>Agent:</strong> <?php echo htmlspecialchars($agent_name); ?>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Category:</strong> <?php echo htmlspecialchars($ticket['category']); ?>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <strong>Status:</strong> <span class="<?php echo $status_class; ?>"><?php echo $status_text; ?></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Created:</strong> <?php echo date('d-m-Y H:i', strtotime($ticket['date_time'])); ?>
                                                        </div>
                                                    </div>

                                                    <?php 
                                                     // Conversation history
                                                     $responses = $admin->get_support_ticket_responses($ticket['id']);
                                                     echo '<hr><h6 class="mb-2">Conversation</h6>';
                                                     echo '<div class="list-group mb-3" style="max-height: 360px; overflow:auto;">';
                                                     if($responses && count($responses) > 0) {
                                                                                             foreach($responses as $res) {
                                        // Check if commentby is an admin (since we're on admin page, any commentby that's not 0 is admin)
                                        $isAdmin = (isset($res['commentby']) && $res['commentby'] !== '' && $res['commentby'] !== '0');
                                        $who = $isAdmin ? 'Admin' : 'Agent';
                                        $badge = $isAdmin ? 'bg-secondary' : 'bg-success';
                                        $commentText = isset($res['comment']) ? $res['comment'] : '';
                                                             echo '<div class="list-group-item">';
                                                             echo '<div class="d-flex justify-content-between">';
                                                             echo '<span class="badge '.$badge.'">'.$who.'</span>';
                                                             echo '<small class="text-muted">ID: '.$res['id'].'</small>';
                                                             echo '</div>';
                                                             echo '<div class="mt-2">'.nl2br(htmlspecialchars($commentText)).'</div>';
                                                             echo '</div>';
                                                         }
                                                     } else {
                                                         echo '<div class="list-group-item text-muted">No messages yet.</div>';
                                                     }
                                                     echo '</div>';
                                                     ?>
                                                    
                                                    <!-- Add response form -->
                                                    <hr>
                                                    <h6>Add Response</h6>
                                                    <form method="post" action="<?php echo $base_url.'index.php?action=admin&query=save_support_response';?>">
                                                        <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
                                                        <div class="mb-3">
                                                            <textarea class="form-control" name="response" rows="3" placeholder="Enter your response..." required></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary btn-sm">Send Response</button>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Status Update Modal -->
                                    <div class="modal fade" id="statusModal<?php echo $ticket['id']; ?>" tabindex="-1" aria-labelledby="statusModalLabel<?php echo $ticket['id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="statusModalLabel<?php echo $ticket['id']; ?>">
                                                        Update Status - Ticket #<?php echo $ticket['id']; ?>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" action="<?php echo $base_url.'index.php?action=admin&query=update_ticket_status';?>">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
                                                        <div class="mb-3">
                                                            <label class="form-label">Status</label>
                                                            <select name="status" class="form-select" required>
                                                                <option value="0" <?php echo ($ticket['status'] == '0') ? 'selected' : ''; ?>>Open</option>
                                                                <option value="1" <?php echo ($ticket['status'] == '1') ? 'selected' : ''; ?>>In Progress</option>
                                                                <option value="2" <?php echo ($ticket['status'] == '2') ? 'selected' : ''; ?>>Resolved</option>
                                                                <option value="3" <?php echo ($ticket['status'] == '3') ? 'selected' : ''; ?>>Closed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Update Status</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php 
                                        }
                                    } else {
                                        echo '<tr><td colspan="8" class="text-center">No agent tickets found.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Customer Tickets Tab -->
                    <div class="tab-pane fade" id="customer" role="tabpanel" aria-labelledby="customer-tab">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6>Customer Support Tickets</h6>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary btn-sm">All</button>
                                <button type="button" class="btn btn-outline-warning btn-sm">Open</button>
                                <button type="button" class="btn btn-outline-info btn-sm">In Progress</button>
                                <button type="button" class="btn btn-outline-success btn-sm">Resolved</button>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="customerTicketsTable">
                                <thead>
                                    <tr>
                                        <th>Ticket ID</th>
                                        <th>Subject</th>
                                        <th>Customer</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Last Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="8" class="text-center">Customer support tickets will be implemented here.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

<script>
function filterTickets(statusKey) {
    const table = document.getElementById('agentTicketsTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

    const map = { all: 'all', open: '0', progress: '1', resolved: '2', closed: '3' };
    const target = map[statusKey] ?? 'all';

    for (let i = 0; i < rows.length; i++) {
        const row = rows[i];
        const rowStatus = row.getAttribute('data-status');
        if (target === 'all' || rowStatus === target) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
}

document.addEventListener('DOMContentLoaded', function(){
    filterTickets('all');
});
</script> 