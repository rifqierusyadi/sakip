<?php if($record): ?>
<ul class="timeline">
    <?php foreach($record as $row): ?>
    <!-- timeline time label -->
    <li class="time-label">
        <span class="bg-red">
            <?= ddMMMyyyy($row->tanggal); ?>
        </span>
    </li>
    <!-- /.timeline-label -->
    <!-- timeline item -->
    <li>
        <!-- timeline icon -->
        <i class="fa fa-file-text bg-blue"></i>
        <div class="timeline-item bg-gray">
            <span class="time"><i class="fa fa-clock-o"></i>&nbsp;</span>
            <h3 class="timeline-header"><a href="#"><?= $row->judul; ?></a></h3>
            <div class="timeline-body">
                <?= $row->informasi; ?>
            </div>
            <div class="timeline-footer">
                <!-- <a class="btn btn-primary btn-xs"></a> -->
            </div>
        </div>
    </li>
    <?php endforeach; ?>
    <li>
        <i class="fa fa-clock-o bg-gray"></i>
    </li>
    <!-- END timeline item -->
</ul>
<?php endif; ?>