<div class="list-group-item {{ $thread->pinned ? 'pinned' : '' }} {{ $thread->locked ? 'locked' : '' }} {{ $thread->trashed() ? 'deleted' : '' }}" :class="{ 'border-primary': selectedThreads.includes({{ $thread->id }}) }">
  <div class="row align-items-center text-center">
    <div class="col-sm text-md-start">
      <span class="lead">
        <a href="{{ Forum::route('thread.show', $thread) }}" @if (isset($category))style="color: {{ $category->color }};" @endif>{{ $thread->title }}</a>
      </span>
      <br>
      {{ $thread->authorName }} <span class="text-muted">@include ('forum::partials.timestamp', ['carbon' => $thread->created_at])</span>

      @if (! isset($category))
      <br>
      <a href="{{ Forum::route('category.show', $thread->category) }}" style="color: {{ $thread->category->color }};">{{ $thread->category->title }}</a>
      @endif
    </div>
    <div class="col-sm text-md-end">
      @if ($thread->pinned)
      <span class="badge rounded-pill bg-info">{{ trans('forum::threads.pinned') }}</span>
      @endif
      @if ($thread->locked)
      <span class="badge rounded-pill bg-warning">{{ trans('forum::threads.locked') }}</span>
      @endif
      @if ($thread->userReadStatus !== null && ! $thread->trashed())
      <span class="badge rounded-pill bg-success">{{ trans($thread->userReadStatus) }}</span>
      @endif
      @if ($thread->trashed())
      <span class="badge rounded-pill bg-danger">{{ trans('forum::general.deleted') }}</span>
      @endif
      <button type="button" style="    border: none;
    cursor: pointer;
    outline: inherit;" onClick="fetchRepliesUsers(this.id)" class="badge rounded-pill bg-primary" id="{{ $key }}" @if (isset($category))style="background: {{ $category->color }};" data-bs-toggle="modal" data-bs-target="#repliesModal" id="{{ $key }}" value="{{ $thread->id }}" @endif>
        {{ trans('forum::general.replies') }}:
        {{ $thread->reply_count }}
      </button>
      <button type="button" class="badge rounded-pill bg-like" style="background: #28a745; border: none; cursor: pointer; outline: inherit;" data-bs-toggle="modal" data-bs-target="#likesModal" id="{{ $key }}" onClick="fetchLikesUsers(this.id)" value="{{ $thread->id }}"> Likes: {{ $thread->likes }}
      </button>
      <div class="modal fade" id="likesModal" tabindex="-1" aria-labelledby="likesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="likesModalLabel">People that liked this thread</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <ul class="list-group" style="text-align: left" id="likesUsersList">
                <li class="list-group-item" id="likesModalContent"></li>
              </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="repliesModal" tabindex="-1" aria-labelledby="repliesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="repliesModalLabel">People that replied in this thread</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <ul class="list-group" style="text-align: left" id="repliesUsersList">
                <li class="list-group-item" id="repliesModalContent"></li>
              </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    @if ($thread->lastPost)
    <div class="col-sm text-md-end text-muted">
      <a href="{{ Forum::route('thread.show', $thread->lastPost) }}">{{ trans('forum::posts.view') }} &raquo;</a>
      <br>
      {{ $thread->lastPost->authorName }}
      <span class="text-muted">@include ('forum::partials.timestamp', ['carbon' => $thread->lastPost->created_at])</span>
    </div>
    @endif

    @if (isset($category) && isset($selectableThreadIds) && in_array($thread->id, $selectableThreadIds))
    <div class="col-sm" style="flex: 0;">
      <input type="checkbox" name="threads[]" :value="{{ $thread->id }}" v-model="selectedThreads">
    </div>
    @endif
  </div>
</div>
<script type="application/javascript">
  function fetchLikesUsers(clickedButtonId) {
    const forumThreadLikeUsers = @json($forum_thread_like_users);
    const forumThreadId = document.getElementById(clickedButtonId).value;

    const users = forumThreadLikeUsers.filter(forumThreadLikeUsers => forumThreadLikeUsers.forum_thread_id.toString() === forumThreadId);

    const ul = document.getElementById("likesUsersList");

    ul.replaceChildren();
    for (i = 0; i < users.length; i++) {
      ul.insertAdjacentHTML('beforeend', `<a href="#" class="list-group-item list-custom list-group-item-action" id="likesModalContent">${users[i].user.name} ${users[i].user.surname}</a>`);
    }
  }
    function fetchRepliesUsers(clickedButtonId) {
    const forumThreadReplyUsers = @json($forum_thread_reply_users);
    const forumThreadId = document.getElementById(clickedButtonId).value;
      console.log('s');
    const users = forumThreadReplyUsers.filter(forumThreadReplyUsers => forumThreadReplyUsers.thread_id.toString() === forumThreadId);
    const ul = document.getElementById("repliesUsersList");

    ul.replaceChildren();
    for (i = 0; i < users.length; i++) {
      ul.insertAdjacentHTML('beforeend', `<a href="#" class="list-group-item list-custom list-group-item-action" id="repliesModalContent">${users[i].user.name} ${users[i].user.surname}</a>`);
    }
  }
</script>