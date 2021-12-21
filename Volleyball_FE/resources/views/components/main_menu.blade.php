<div class="mainmenu pull-left">
    <ul class="nav navbar-nav collapse navbar-collapse">
        <li><a href="{{ route('home') }}" class="active">Home</a></li>
        @foreach($categoriesLimit as $categoryParent)
            <li class="dropdown">
                <a href="{{ route('category.product',['slug'=>$categoryParent->slug,
                    'id'=>$categoryParent->id]) }}">{{ $categoryParent->name }}
                    <i class="fa fa-angle-down"></i>
                </a>

                @include('components.child_menu', ['$categoryParent'=>$categoryParent])

            </li>
        @endforeach
    </ul>
</div>
