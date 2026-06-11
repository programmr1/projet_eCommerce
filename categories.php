<?php include 'init.php'; ?>

    <div class="container mt-4">
        <h1 class="text-center mb-4">
            <?php echo str_replace('-', ' ', $_GET['pagename'] ?? 'لايوجد حاليا عناصر لهذا القسم'); ?>
        </h1>

        <div class="row">
            <?php
            // تأكد من وجود دالة getItem وتمرير المتغير بشكل آمن
            $pageID = $_GET['pageID'] ?? 0;
            foreach (getItem($pageID) as $item) {
                echo '<div class="col-sm-6 col-md-4 mb-4">'; // بداية عمود العنصر
                echo '  <div class="thumbnail card p-3 h-100 shadow-sm">';
                echo '<span class="badge bg-success rounded-pill px-3 py-2 text-dark align-self-start">$' . $item['priceItem'] . '</span>';
                echo '      <img class="img-fluid rounded" src="img.png" alt="" />'; // الكلاس الصحيح للصور
                echo '      <div class="caption mt-2">';
                echo '          <h3 class="fs-5">' . $item['itemName'] . '</h3>';
                echo '          <p class="text-muted">' . $item['descriptionItem'] . '</p>';
                echo '      </div>';
                echo '  </div>';
                echo '</div>'; // ✅ هنا تم إضافة الإغلاق المفقود للعمود
            }
            ?>
        </div>
    </div>

<?php include $tpl.'footer.php'; ?>