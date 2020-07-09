<?php require APPROOT . '/views/inc/header.php';?>
<div id="grow" class="container2">
    <h3><a href="?ym=<?php echo $data['prev']; ?>">&lt;</a> <?php echo $data['html_title']; ?> <a href="?ym=<?php echo $data['next']; ?>">&gt;</a></h3>
    <table class="table table-bordered ">
        <tr>
            <th>S</th>
            <th>M</th>
            <th>T</th>
            <th>W</th>
            <th>T</th>
            <th>F</th>
            <th>S</th>
        </tr>
        <?php foreach ($data['weeks'] as $week) : ?>
            <?php print($week); ?>
        <?php endforeach ?>
    </table>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>