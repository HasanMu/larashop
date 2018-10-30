@extends('layouts.global')
@section('footer-scripts')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
$('#categories').select2({
    ajax: {
        url: 'http://larashop.test/ajax/categories/search',
            processResults: function(data){
            return {
                results: data.map(function(item){
                    return {
                        id: item.id, text:
                        item.name
                        } 
                })
                }
            }
        }
    });
</script>

@endsection
@section('title') Create book @endsection

@section('content')

    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <form
            action="{{route('books.store')}}"
            method="POST"
            enctype="multipart/form-data"
            class="shadow-sm p-3 bg-white"\>
            @csrf

            <label for="title">Title</label>
            <input 
                type="text" 
                name="title"
                class="form-control"
                placeholder="Books title">
            <br>
            
            <label for="cover">Cover</label>
            <input 
                type="file" 
                name="cover"
                class="form-control">
            <br>

            <label for="cover">Description</label>
            <textarea 
                    name="description" 
                    id="description" 
                    class="form-control" 
                    placeholder="Give a description about this book" >
            </textarea>
            <br>

            <label for="categories">Categories</label><br>
            <select
                name="categories[]"
                multiple
                id="categories"
                class="form-control">
            </select>
            <br><br/>

            <label for="stock">Stock</label>
            <input 
                type="number"
                id = "stock"
                min=0
                value=0 
                name="stock" 
                class="form-control">
            <br>

            <label for="author">Author</label><br>
            <input 
                type="text" 
                class="form-control" 
                name="author" 
                id="author"
                placeholder="Book author">
            <br>
            
            <label for="publisher">Publisher</label> <br>
            <input 
                type="text" 
                class="form-control" 
                id="publisher"
                name="publisher" 
                placeholder="Book publisher">
            <br>

            <label for="Price">Price</label> <br>
            <input 
                type="number" 
                class="form-control" 
                name="price" 
                id="price"
                placeholder="Book price">
            <br>

            <button
                class="btn btn-primary"
                name="save_action"
                value="PUBLISH">Publish</button>

            <button
                class="btn btn-secondary"
                name="save_action"
                value="DRAFT">Save as draft</button>
            </form>
        </div>
    </div>

@endsection