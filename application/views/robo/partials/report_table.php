<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Nome do Paciente</th>
            <th>Risco</th>
            <th>Análise IA</th>
            <th>Análise</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reports as $report): ?>
            <tr class="report-row">
                <td><?php echo $report->id; ?></td>
                <td>
                    <img src="<?php echo base_url('/assets/uploads/files/'.$report->foto); ?>" alt="Foto de <?php echo $report->paciente_nome; ?>" class="img-thumbnail" style="width: 50px; height: 50px;">
                </td>
                <td class="patient-name"><a href="<?php echo site_url('paciente/perfil/'.$report->paciente_id); ?>"><?php echo $report->paciente_nome; ?></a></td>
                <td><?php echo $report->risco; ?></td>
                <td><?php echo $report->analiseIA; ?></td>
                <td><?php echo base64_decode($report->analise); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
