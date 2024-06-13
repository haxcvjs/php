<nav aria-label="Page navigation">
    <ul class="pagination pagination-lg">
        <li class="page-item prev {{$page == 1 ? 'disabled' : ''}}">
            <a class="page-link" href="?page={{$page  - 1}}"><i class="tf-icon bx bx-chevrons-left"></i></a>
        </li>
        @if($start > 1)
        <li class="page-item">
            <a class="page-link" href="?page=1">1</a>
        </li>
        <li class="page-item disabled">
            <a class="page-link" >...</a>
        </li>
        @endif
        @for ($i = $start; $i <= $end; $i++)
        <li class="page-item {{$page == $i ? 'active': ''}}">
            <a class="page-link" href="?page={{$i}}">{{$i}}</a>
        </li>
        @endfor

        @if($end < $last)
        <li class="page-item disabled">
            <a class="page-link" >...</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="?page={{$last}}">{{$last}}</a>
        </li>
        @endif

        <li class="page-item next {{$page == $last ? 'disabled' : ''}}">
            <a class="page-link" href="?page={{$page  + 1}}"><i class="tf-icon bx bx-chevrons-right"></i></a>
        </li>
    </ul>
</nav>