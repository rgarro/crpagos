<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<!-- <div class="<?= h($class) ?>" onclick="this.classList.add('hidden');"><?= $message ?></div> -->
<script>
new Noty({
    text: '<?= $message ?>',
    type:'alert',
    timeout:4000,
      layout:'top',
    animation: {
        open: 'animated bounceInLeft', // Animate.css class names
        close: 'animated bounceOutLeft', // Animate.css class names
    }
}).show();
</script>
