
<div class="news-bar">
    <div class="container-fluid">
        <div class="{{ $content['motion'] === 'scrolling' ? 'news-track' : 'news-static' }}">
            <span class="news-item">
                {{ $content['notice_descrioption'] ?? '' }}
            </span>
        </div>
    </div>
</div>