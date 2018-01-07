<!DOCTYPE>
<?php
include("includes/db.php");
 ?>
<html>
  <head>
      <title>
        Inserting Products
      </title>
      <script
        src="https://cloud.tinymce.com/stable/tinymce.min.js">
      </script>
      <script>
        tinymce.init({ selector:'textarea' });
      </script>
  </head>

  <body bgcolor='skyblue'>
    <form action="insert_product.php" method="post" enctype="multipart/form-data">
      <table align="center" width="600" border="2" bgcolor="orange" >

        <tr align="center">
          <td colspan="7">
            <h2>Insert New Post</h2>
          </td>
        </tr>

        <tr>
          <td
              align="right">
              <b>
                Product Title:
              </b>
          </td>
          <td>
            <input type="text" name="Product_Title" size="60" required/>
          </td>
        </tr

        <tr>
          <td align="right">
            <b>Product Category:</b>
          </td>
          <td>
            <select name="product_cat" required>
            <option>
              Select a Category
            <?php
              $get_cats= "select * from categories";
              $run_cats= mysqli_query($con, $get_cats);
              while ($row_cats= mysqli_fetch_array($run_cats))
               {
                 $cat_id=$row_cats['cat_id'];
                 $cat_title=$row_cats['cat_title'];
                echo "<option value='$cat_id'>$cat_title</option>";
               }
            ?>
          </td>
        </tr

        <tr>
          <td align="right">
            <b>Product Brand:</b>
          </td>
          <td>
          <select name="product_brand" required>
          <option>
          Select a Category
          <?php
            $get_brands= "select * from brands";
            $run_brands= mysqli_query($con, $get_brands);
            while ($row_brands= mysqli_fetch_array($run_brands))
            {
              $brand_id=$row_brands['brand_id'];
              $brand_title=$row_brands['brand_title'];
              echo "<option value='$brand_id'>$brand_title</option>";
            }
          ?>
          </td>
        </tr

        <tr>
          <td align="right">
            <b>Product Image:</b>
          </td>
          <td>
            <input type="file" name="Product_Image" required/>
          </td>
        </tr

        <tr>
          <td align="right">
            <b>Product Price:</b>
          </td>
          <td>
            <input type="text" name="Product_Price" required/>
          </td>
        </tr


        <tr>
          <td align="right">
            <b>Product Description:</b>
          </td>
          <td>
            <textarea
              name="product_desc" cols="20" rows="10">
            </textarea>
          </td>
        </tr

        <tr>
          <td align="right">
            <b>
              Product Keywords:
            </b>
          </td>
          <td>
            <input type="text" name="Product_Keywords" size="50"/>
          </td>
        </tr

        <tr align="center">
          <td colspan="7">
            <input type="submit" name="insert_post" value="Insert Now"/>
          </td>
        </tr>

      </table>
    </form>
  </body>
</html>

<?php
if(isset($_POST['insert_post']))
{
  //Getting the text data from the fields
  $Product_Title=$_POST['Product_Title'];
  $product_cat=$_POST['product_cat'];
  $product_brand=$_POST['product_brand'];
  $Product_Price=$_POST['Product_Price'];
  $product_desc=$_POST['product_desc'];
  $Product_Keywords=$_POST['Product_Keywords'];

  //Getting the image from the field
  $Product_Image=$_FILES['Product_Image']['name'];
  $Product_Image_tmp=$_FILES['Product_Image']['tmp_name'];

  move_uploaded_file($Product_Image_tmp,"product_images/$Product_Image");

  //Query to insert into products table
  $insert_product="insert into products
  (product_cat,product_brand,Product_title,Product_price,product_desc,product_image,Product_keywords) values
  ('$product_cat','$product_brand','$Product_Title','$Product_Price','$product_desc','$Product_Image','$Product_Keywords')";

  $insert_pro=mysqli_query($con,$insert_product);

  if($insert_pro)
  {
    //Message after inserting the records
    echo "<script>alert('Product has been inserted !!')</script>";
    //Navigate to blank produc insert page
    echo "<script>window.open('insert_product.php','_self')</script>";
  }
}
 ?>
