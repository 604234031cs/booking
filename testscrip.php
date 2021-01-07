<?php
require 'head.php';
?>
<button onclick="test('1')">1</button>
<button onclick="test('2')">2</button>
<button onclick="test('3')">3</button>

<p id="p"></p>

<script>
    function test(n) {
        if (n == '1') {
            $("#p").html("1");
        } else if (n == '2') {
            $("#p").html("2");
        } else if (n == '3') {
            $("#p").html("3");
        }

    }
</script>