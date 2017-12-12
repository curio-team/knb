<div class="event-goal">
    <span>{{ $goal->title }}</span>
    <div class="progress-bar">
        <div class="progress" style="width: {{ $goal->getProgressPercentage() }}%;">

        </div>
        <div class="center-content-abs">
            <span>{{ $goal->getProgressPercentage() }}%</span>
        </div>
    </div>
</div>