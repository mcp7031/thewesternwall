
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <ul class="divide-y">
                @if (count($telegramposts) == 0)
                <span class="text-sm text-gray-600">
                    There are no posts to display
                </span>
                @endif

                @foreach($telegramposts as $post)
                <span class="text-sm text-gray-600">
                <li>
                <a href = "#" class="text-sm font-semibold block">{!! $post->title !!} </a>
                        {{ Carbon\Carbon::parse($post->date)->diffForHumans() }}
                </li>
                </span>

                @endforeach
            </ul>
            {{ $telegramposts->links() }}
        </div>
