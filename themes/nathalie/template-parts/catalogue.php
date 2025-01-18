<div class="photo-catalogue">
    <!-- Filtres -->
    <form id="filter-form">
        <div class="align">
        <select id="filter-category" name="cateegorie">
        <option value="">CATÉGORIE</option>
        <?php
        $photo_categories = get_terms('cateegorie');
        foreach ($photo_categories as $category) {
            echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
        }
        ?>
        </select>
        <select id="filter-format" name="format">
        <option value="">FORMAT</option>
        <?php
        $photo_formats = get_terms('format');
        foreach ($photo_formats as $format) {
            echo '<option value="' . $format->slug . '">' . $format->name . '</option>';
        }
        ?>
        </select>

     </div>
        <select id="fc" name="date">
        <option value="">TRIER PAR</option>
            <option value="desc">Les plus récentes</option>
            <option value="asc">Les plus anciennes</option>
        </select>
    </form>

    <!-- Liste des photos -->
    <div id="photo-list" class="photos-grid">
        <!-- Les photos seront affichées dynamiquement -->
    </div>

    <!-- Bouton Charger Plus -->
   <div class="btn_charger">
    <button id="load-more" data-page="1">Charger plus</button>
    </div>
</div>
