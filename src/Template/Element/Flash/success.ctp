<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<script>
new Noty({
    text: '<?= $message ?>',
    type:'success',
      layout:'top',
      timeout:4000,
    animation: {
        open: 'animated bounceInLeft', // Animate.css class names
        close: 'animated bounceOutLeft', // Animate.css class names
    }
}).show();
</script>
