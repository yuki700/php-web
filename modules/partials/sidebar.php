<?php
    $features = ['Feature 1', 'Feature 2', 'Feature 3', 'Feature 4', 'Feature 5', 'Feature 6'];
?>
<div id="sidebar">
    <h3> Sidebar </h3>
    <ul>
    <?php foreach($features as $feature) { ?>
        <li><?php echo $feature; ?></li>
    <?php } ?>
    </ul>
</div>
