<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style type="text/css">
        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
        }

        table {
           border: 2px solid black;
           text-align: center;
           width: 800px;
        }

        th {
            border: 2px solid black;
            text-align: center;
            color: white;
            font: 20px;
            font-weight: bold;
            background-color: black;
        }

        td{
            border: 1px solid skyblue;
        }


    </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
  
  </div>
  <!-- end hero area -->
<div class="div_deg">
    <table>
        <tr>
            <th>Product Title</th>
            <th>Price</th>
            <th>Image</th>
        </tr>

        @foreach ($cart as $cart)
        <tr>
            <td>{{$cart->product->title}}</td>
            <td>{{$cart->product->price}}</td>
            <td style="position: relative;">
        <img width="150" src="/products/{{$cart->product->image}}">
        <form action="{{ url('remove_cart', $cart->id) }}" method="POST" style="position: absolute; bottom: 10px; right: 10px;">
            @csrf
            @method('DELETE')
            <button type="submit" style="background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">Remove</button>
        </form>
    </td>
            
            @endforeach
        </tr>

    </table>
</div>

   

  <!-- info section -->
   @include('home.footer')
  
</body>

</html>