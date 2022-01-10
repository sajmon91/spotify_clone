
<nav class="optionsMenu">
    <input type="hidden" class="SongId">
    <select class='item playlistSelect'>
        <option value=''>Add to playlist</option>
        <?php echo $playlist_obj->getPlaylistsDropdown($user_id); ?>
    </select>
    <a class="item download" download>Download</a>
</nav>