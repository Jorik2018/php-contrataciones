<div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:20%">
        <h3>Convocatorias CAS</h3>
        <?php
        function extractFinalizedYear($url)
        {
                // Use parse_url to get the path from the URL
                $path = parse_url($url, PHP_URL_PATH);
                // Use regex to match "finalizadas-<year>" pattern
                if (preg_match('/finalizadas-\d{4}/', $path, $matches)) {
                        return $matches[0]; // Return the matched pattern
                }
                return null; // Return null if pattern is not found
        }
        $path=extractFinalizedYear($_SERVER['REQUEST_URI']);
        ?>
        <ul>
                <li class="page_item page-item-174 current_page_item"><a
                class="<?=!$path?'bold':''?>"
                                href="/contrataciones/vigentes/"
                                aria-current="page">Convocatorias vigentes</a></li>

        <?php 
        for($i=2025;$i>=2025;$i--){
             
                ?>
                   <li class="page_item page-item-109487"><a class="<?=("finalizadas-$i")==$path?'bold':''?>"
                                href="/contrataciones/finalizadas-<?=$i?>/">Finalizadas <?=$i?></a>
                </li>
                <?php
        }
        ?>
        </ul>
</div>