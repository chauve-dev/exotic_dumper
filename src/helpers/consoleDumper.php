<?php


use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

function console_dump($data, $name = 'ExoticDumper log', $type = 'log') {
    $encoder = new JsonEncoder();
    $normalizer = new ObjectNormalizer();

    $serializer = new Serializer([$normalizer], [$encoder]);

    $data = $serializer->serialize($data, 'json');
    ?>
        <script>
            console.group('<?= $name ?>');
            console.warn('This log is from php ExoticDumper');
            console.debug('source file : <?= debug_backtrace()[0]['file'] ?>');
            console.<?= $type ?>(<?= $data ?>);
            console.groupEnd();
        </script>
    <?php
}