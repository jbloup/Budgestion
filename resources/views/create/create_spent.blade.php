@extends('layouts.app')

@section('content')
    <div class="card mb-6">
        <form method="POST" action="{{route('store_spent')}}">
            @csrf
            <input type="text" name="name">@error('name')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
            <input type="text" name="description">@error('description')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
            <input type="text" name="price">@error('price')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
            <input  type="date" name="date">
            @error('date')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
            <select>
                <option name="category_id" value="1">catégorie</option>
            </select>
            <select>
                <option name="type_id" value="1">catégorie</option>
            </select>
            <select>
                <option name="family_id" value="1">catégorie</option>
            </select>
            <select>
                <option name="account_id" value="1">catégorie</option>
            </select>
            <button type="submit" class="button is-primary ">Créer une dépense</button>
            @if($message_success != "")
                <span class="help is-success">{{ $message_success }}</span>
            @endif
            @if($e != "")
                <span class="help is-success">{{ $e }}</span>
            @endif

    </form>
    </div>
    <tr>
        @foreach($spents as $spent)
        <th>{{ $spent->name }}</th>
        <th>{{ $spent->description }}</th>
        <th>{{ $spent->price }}</th>
        <th>{{ $spent->date }}</th>
        @endforeach
    </tr>
    <script type="text/javascript">
        var langId = "{{asset('vendor/select2/js/i18n/id.js')}}";
        $(document).ready(function () {
            //on change type
            $('#select_type_id').change(function (e) {
                $.ajax({
                    url: "<?= url('/create/spent/getFamilies/') ?>/" + $(this).val(),
                    method: 'GET',
                    success: function (data) {
                        //console.log(data);

                        $('#select_family_id').children('option:not(:first)').remove().end();

                        $.each(data,function(index,familyObj){
                            $('#select_family_id').append('<option value="'+familyObj.id+'"> '+familyObj.name+' </option>')
                        });
                    }
                });
            });

        });
    </script>
@endsection

<!--

<header class="card-header">
                <div class="card-header-title">
                    <h1 class="title">Complétez informations dépense</h1>
                </div>
            </header>
            <div class="card-content">
                <div class="mb-5">
                    <label for="name" class="label">Désignation de la dépense</label>
                    <input id="name" type="text" name="name" class="input" value="{{ old('name') }}"
                           placeholder="Nom dépense" autofocus>
                    @error('name')
    <span class="help is-danger">{{ $message }}</span>
                    @enderror
    </div>
    <div class="mb-5">
        <label for="description" class="label">Description de la dépense</label>
        <textarea id="description" name="description" class="textarea" value="{{ old('description') }}"
                              placeholder="Description dépense ..."></textarea>
                    @error('description')
    <span class="help is-danger">{{ $message }}</span>
                    @enderror
    </div>
    <div class="mb-5">
        <label for="price" class="label">Montant de la dépense</label>
        <input id="price" type="number"  step=".01" name="price" class="input" value="{{ old('price') }}"
                           placeholder="Prix ...">
                    @error('price')
    <span class="help is-danger">{{ $message }}</span>
                    @enderror
    </div>
    <div class="mb-5">
        <label for="date" class="label">Date de la dépense</label>
        <input id="date" type="date" name="date" class="input" value="{{ old('date') }}">
                    @error('date')
    <span class="help is-danger">{{ $message }}</span>
                    @enderror
    </div>
    <div class="field-body">
        <div class="fied">

    <div class="mb-5">
        <label for="category_id" class="label">Catégorie</label>
        <div class="control">
            <div class="select">
                <select class="select" id="category_id" name="category_id">
                    <option value="">categorie ...</option>
@foreach($categories as $category)
    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
    </select>
</div>
</div>
@error('category')
    <span class="help is-danger">{{ $message }}</span>
                    @enderror
    </div>


        </div>
        <div class="fied">

    <div class="mb-5">
        <label for="type_id" class="label">Type</label>
        <div class="control">
            <div class="select">
                <select class="select" id="select_type_id" name="type_id">
                    <option value="">Type ...</option>
@foreach($types as $type)
    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
    </select>
</div>
</div>
@error('type')
    <span class="help is-danger">{{ $message }}</span>
                    @enderror
    </div>

        </div>
        <div class="fied">

    <div class="mb-5">
        <label for="family_id" class="label">Sous-Type</label>
        <div class="control">
            <div class="select">
                <select class="select" id="select_family_id" name="family_id">
                    <option value="">sous-type ...</option>


                </select>
            </div>
        </div>
@error('family')
    <span class="help is-danger">{{ $message }}</span>
                    @enderror
    </div>

    </div>
    </div>

    <div class="mb-5">
        <label for="account_id" class="label">Compte bancaire</label>
        <div class="control">
            <div class="select">
                <select class="select" id="account_id" name="account_id">
                    <option value="">compte ...</option>
@foreach($accounts as $account)
    <option value="{{$account->id}}">{{$account->name}}</option>
                                @endforeach
    </select>
</div>
</div>
@error('account')
    <span class="help is-danger">{{ $message }}</span>
                    @enderror
    </div>

<footer class="card-footer">
    <div class="card-footer-item column">
        <button type="submit" class="button is-primary ">Créer une dépense</button>
@if($message_success != "")
    <span class="help is-success">{{ $message_success }}</span>
                    @endif
    </div>
</footer>
</div>

-->
