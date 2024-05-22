<style>
    .nav-link {
    transition: background-color 0.3s ease, color 0.3s ease;
}

.nav-link:hover {
    background-color: #007bff;
    color: white;
}

.table-striped tbody tr {
    transition: background-color 0.3s ease;
}

.table-striped tbody tr:hover {
    background-color: #f1f1f1;
}

</style>

    <div class="d-flex align-items-center">
        <h5 class="mb-0">Relatórios Robô</h5>
        <form class="ms-auto position-relative">
            <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                <ion-icon name="search-sharp" role="img" class="md hydrated" aria-label="search sharp"></ion-icon>
            </div>
            <input id="search-patient" class="form-control ps-5" type="text" placeholder="Pesquisar paciente">
        </form>
    </div>

    <ul class="nav nav-tabs mt-3" id="reportTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-reports-tab" data-bs-toggle="tab" data-bs-target="#all-reports" type="button" role="tab" aria-controls="all-reports" aria-selected="true">Todos os Relatórios</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="low-risk-tab" data-bs-toggle="tab" data-bs-target="#low-risk" type="button" role="tab" aria-controls="low-risk" aria-selected="false">Baixo Risco</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="medium-risk-tab" data-bs-toggle="tab" data-bs-target="#medium-risk" type="button" role="tab" aria-controls="medium-risk" aria-selected="false">Médio Risco</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="high-risk-tab" data-bs-toggle="tab" data-bs-target="#high-risk" type="button" role="tab" aria-controls="high-risk" aria-selected="false">Alto Risco</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="urgent-risk-tab" data-bs-toggle="tab" data-bs-target="#urgent-risk" type="button" role="tab" aria-controls="urgent-risk" aria-selected="false">Urgente</button>
        </li>
    </ul>

    <div class="tab-content mt-3" id="reportTabsContent">
        <div class="tab-pane fade show active" id="all-reports" role="tabpanel" aria-labelledby="all-reports-tab">
            <?php echo $this->load->view('robo/partials/report_table', ['reports' => $reports], true); ?>
        </div>
        <div class="tab-pane fade" id="low-risk" role="tabpanel" aria-labelledby="low-risk-tab">
            <?php echo $this->load->view('robo/partials/report_table', ['reports' => array_filter($reports, function($report) { return $report->risco == 'baixo'; })], true); ?>
        </div>
        <div class="tab-pane fade" id="medium-risk" role="tabpanel" aria-labelledby="medium-risk-tab">
            <?php echo $this->load->view('robo/partials/report_table', ['reports' => array_filter($reports, function($report) { return $report->risco == 'medio'; })], true); ?>
        </div>
        <div class="tab-pane fade" id="high-risk" role="tabpanel" aria-labelledby="high-risk-tab">
            <?php echo $this->load->view('robo/partials/report_table', ['reports' => array_filter($reports, function($report) { return $report->risco == 'alto'; })], true); ?>
        </div>
        <div class="tab-pane fade" id="urgent-risk" role="tabpanel" aria-labelledby="urgent-risk-tab">
            <?php echo $this->load->view('robo/partials/report_table', ['reports' => array_filter($reports, function($report) { return $report->risco == 'urgente'; })], true); ?>
        </div>
    </div>

<script>
    document.getElementById('search-patient').addEventListener('input', function() {
        var searchTerm = this.value.toLowerCase();
        document.querySelectorAll('.report-row').forEach(function(row) {
            var patientName = row.querySelector('.patient-name').textContent.toLowerCase();
            if (patientName.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
