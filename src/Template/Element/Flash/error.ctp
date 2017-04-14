<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<!-- <div class="message error" onclick="this.classList.add('hidden');"><?= $message ?></div> -->
<script>
new Noty({
    text: '<?= $message ?>',
    type:'error',
    timeout:4000,
    layout:'top',
    animation: {
        open: 'animated bounceInLeft', // Animate.css class names
        close: 'animated bounceOutLeft', // Animate.css class names
    }
}).show();
</script>
