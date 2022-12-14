<?php

use Symfony\Component\VarDumper\VarDumper;

/**
 * @param mixed $data data to display
 * @param bool $hide should hide dump ?
 * @param string $name name of the dump
 * @return void
 */
function pretty_dump($data, $hide = false, $name = 'var_dump')
{
    $id = uniqid();
    ?>
    <div onclick="clicked_dump(this)" id="<?= $id ?>" class="var_dump_exotic<?= $hide ? ' hide' : '' ?>">
        <div id="<?= $id ?>header" class="var_dump_exotic-title">
            <span><?= $name ?></span>
            <span class="var_dump_exotic-actions">
                <span onclick="min('<?= $id ?>')" id="min-<?= $id ?>"></span>
                <span onclick="hide('<?= $id ?>')" id="toggle-<?= $id ?>"></span>
            </span>
        </div>
        <style>
            .var_dump_exotic.hide {
                position: fixed;
                bottom: 0;
                left: 0;
                overflow: hidden;
                resize: none;
            }

            .var_dump_exotic-container {
                overflow: auto;
                height: calc(100% - 30px);
            }

            .var_dump_exotic.hide .var_dump_exotic-container {
                height: 0;
                padding: 0;
                margin: 0;
            }

            .var_dump_exotic {
                position: fixed;
                border: 2px solid red;
                z-index: 999;
                resize: both;
                overflow: hidden;
                min-width: 150px;
                background-color: #18171B;
            }


            .var_dump_exotic-container::-webkit-scrollbar-track
            {
                background-color: #18171B;
            }

            .var_dump_exotic-container::-webkit-scrollbar
            {
                width: 10px;
                background-color: #18171B;
            }

            .var_dump_exotic-container::-webkit-scrollbar-thumb
            {
                background-color: #4f4f4f;
            }

            .var_dump_exotic a {
                text-decoration: none;
            }

            .var_dump_exotic:active {
                z-index: 1001;
                border-color: lawngreen;
            }

            .var_dump_exotic:target {
                z-index: 1000;
                border-color: lawngreen;
            }

            .var_dump_exotic .var_dump_exotic-actions {
                display: flex;
                gap: 10px;
            }

            .var_dump_exotic > .var_dump_exotic-title {
                display: flex;
                background: black;
                justify-content: space-between;
                align-items: center;
                color: white;
                padding: 4px;
                height: 30px;
                font-family: "Arial", sans-serif;
            }

            .var_dump_exotic > .var_dump_exotic-title #toggle-<?= $id ?> {
                background-color: red;
                width: 15px;
                height: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .var_dump_exotic > .var_dump_exotic-title #min-<?= $id ?> {
                background-color: yellow;
                width: 15px;
                height: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .var_dump_exotic.hide > .var_dump_exotic-title #toggle-<?= $id ?> {
                background-color: lime;
            }

            .var_dump_exotic > pre {
                margin: 0;
            }
        </style>
        <div class="var_dump_exotic-container"><?php VarDumper::dump($data); ?></div>
        <script>
            order_dump();
            function clicked_dump(e) {
                set_active(e.id)
                order_dump();
            }

            function hide(id) {
                document.getElementById(id).classList.toggle('hide');
                document.getElementById(id).style.left = '';
                document.getElementById(id).style.top = '';
            }

            function min(id) {
                document.getElementById(id).style.height = '20vh';
            }

            function order_dump(){
                let prev = 0;
                document.querySelectorAll('.var_dump_exotic.hide').forEach(el => {
                    el.style.left = prev;
                    el.style.top = '';
                    el.style.width = '';
                    el.style.height = '';
                    prev = el.clientWidth + prev
                });
            }

            function set_active(id) {
                window.location = `#${id}`
            }

            dragElement(document.getElementById("<?= $id ?>"));

            function dragElement(elmnt) {
                var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
                if (document.getElementById(elmnt.id + "header")) {
                    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
                } else {
                    elmnt.onmousedown = dragMouseDown;
                }

                function dragMouseDown(e) {
                    e = e || window.event;
                    e.preventDefault();
                    if(e.target.closest('.var_dump_exotic.hide') !== null) {
                        return false;
                    }
                    pos3 = e.clientX;
                    pos4 = e.clientY;
                    document.onmouseup = closeDragElement;
                    document.onmousemove = elementDrag;
                }

                function elementDrag(e) {
                    e = e || window.event;
                    e.preventDefault();
                    pos1 = pos3 - e.clientX;
                    pos2 = pos4 - e.clientY;
                    pos3 = e.clientX;
                    pos4 = e.clientY;
                    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
                    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
                }

                function closeDragElement() {
                    document.onmouseup = null;
                    document.onmousemove = null;
                }
            }
        </script>
    </div>
    <?php
}
