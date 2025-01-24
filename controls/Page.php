<?php

// Пагинация
echo '<div class="pagination">';
if ($page > 1) {
    echo '<a href="?page=' . ($page - 1) . '&search=' . urlencode($search) . '&rev=' . urlencode($rev) . '&trust=' . urlencode($trust) . '&id=' . urlencode($id) . '">« Предыдущая</a>';
}

for ($i = 1; $i <= $totalPages; $i++) {
    if ($i == $page) {
        echo '<strong>' . $i . '</strong>'; // Текущая страница
    } else {
        echo '<a href="?page=' . $i . '&search=' . urlencode($search) . '&rev=' . urlencode($rev) . '&trust=' . urlencode($trust) . '&id=' . urlencode($id) .'">' . $i . '</a>';
    }
}

if ($page < $totalPages) {
    echo '<a href="?page=' . ($page + 1) . '&search=' . urlencode($search) . '&rev=' . urlencode($rev) . '&trust=' . urlencode($trust) . '&id=' . urlencode($id) . '">Следующая »</a>';
}
echo '</div>';
?>