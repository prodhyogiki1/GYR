<?php
// Check for status messages
if(isset($_GET['status'])) {
    if($_GET['status'] == '1') {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Policy operation completed successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Something went wrong. Please try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
}
?>

<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-3">
        <div class="col-md-6">
            <h4 class="mb-0">All Policies</h4>
        </div>
        <div class="col-md-6 text-end">
            <a href="<?php echo $base_url.'index.php?action=dashboard&page=policy';?>" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i>Add New Policy
            </a>
        </div>
    </div>

    <!-- Policies Data Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Policies List</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="policiesTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Policy Name</th>
                            <th>Policy Type</th>
                            <th>Calculation On</th>
                            <th>Value</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $policies = $admin->get_all_policies();
                        if($policies && count($policies) > 0) {
                            foreach($policies as $policy) {
                                $policy_type_text = ($policy['policy_type'] == '1') ? 'Booking' : 'Cancellation';
                                $policy_type_badge = ($policy['policy_type'] == '1') ? 'success' : 'warning';
                        ?>
                        <tr>
                            <td><?php echo $policy['id']; ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($policy['policy_name']); ?></strong>
                            </td>
                            <td>
                                <span class="badge bg-<?php echo $policy_type_badge; ?>">
                                    <?php echo $policy_type_text; ?>
                                </span>
                            </td>
                            <td>
                                <span class="text-info">
                                    <?php echo htmlspecialchars($policy['calculation_on']); ?>
                                </span>
                            </td>
                            <td>
                                <span class="text-success fw-bold">
                                    <?php echo htmlspecialchars($policy['value']); ?>
                                    <?php echo ($policy['calculation_on'] == 'Percentage') ? '%' : ''; ?>
                                </span>
                            </td>
                            <td><?php echo date('d M Y H:i', strtotime($policy['created_at'])); ?></td>
                            <td><?php echo date('d M Y H:i', strtotime($policy['updated_at'])); ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-primary" onclick="editPolicy(<?php echo $policy['id']; ?>)">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="deletePolicy(<?php echo $policy['id']; ?>, '<?php echo htmlspecialchars($policy['policy_name']); ?>')">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php 
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Edit Policy Modal -->
<div class="modal fade" id="editPolicyModal" tabindex="-1" aria-labelledby="editPolicyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPolicyModalLabel">Edit Policy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPolicyForm" method="post" action="<?php echo $base_url.'index.php?action=admin&query=update_policy'?>">
                    <input type="hidden" id="edit_policy_id" name="policy_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_policy_name" class="form-label">Policy Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_policy_name" name="policy_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_policy_type" class="form-label">Policy Type <span class="text-danger">*</span></label>
                                <select class="form-select" id="edit_policy_type" name="policy_type" required>
                                    <option value="1">Booking</option>
                                    <option value="5">Cancellation</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_calculation_on" class="form-label">Calculation On <span class="text-danger">*</span></label>
                                <select class="form-select" id="edit_calculation_on" name="calculation_on" required>
                                    <option value="Percentage">Percentage</option>
                                    <option value="Amount">Amount</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_value" class="form-label">Value <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="edit_value" name="value" step="0.01" min="0" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="editPolicyForm" class="btn btn-primary">Update Policy</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Policy Modal -->
<div class="modal fade" id="deletePolicyModal" tabindex="-1" aria-labelledby="deletePolicyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePolicyModalLabel">Delete Policy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the policy "<span id="deletePolicyName"></span>"?</p>
                <p class="text-danger">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deletePolicyForm" method="post" action="<?php echo $base_url.'index.php?action=admin&query=delete_policy'?>" style="display: inline;">
                    <input type="hidden" id="delete_policy_id" name="policy_id">
                    <button type="submit" class="btn btn-danger">Delete Policy</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DataTables CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable with advanced features
    $('#policiesTable').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        pageLength: 25,
        order: [[0, 'desc']],
        columnDefs: [
            {
                targets: [7], // Actions column
                orderable: false,
                searchable: false
            }
        ],
        language: {
            search: "Search policies:",
            lengthMenu: "Show _MENU_ policies per page",
            info: "Showing _START_ to _END_ of _TOTAL_ policies",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            }
        }
    });
});

function editPolicy(policyId) {
    // Fetch policy data and populate modal
    fetch('<?php echo $base_url; ?>index.php?action=admin&query=get_policy&id=' + policyId)
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                const policy = data.policy;
                document.getElementById('edit_policy_id').value = policy.id;
                document.getElementById('edit_policy_name').value = policy.policy_name;
                document.getElementById('edit_policy_type').value = policy.policy_type;
                document.getElementById('edit_calculation_on').value = policy.calculation_on;
                document.getElementById('edit_value').value = policy.value;
                
                const modal = new bootstrap.Modal(document.getElementById('editPolicyModal'));
                modal.show();
            } else {
                alert('Error loading policy data');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading policy data');
        });
}

function deletePolicy(policyId, policyName) {
    document.getElementById('delete_policy_id').value = policyId;
    document.getElementById('deletePolicyName').textContent = policyName;
    
    const modal = new bootstrap.Modal(document.getElementById('deletePolicyModal'));
    modal.show();
}

// Auto-hide alerts after 5 seconds
setTimeout(function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        const bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
    });
}, 5000);
</script>
