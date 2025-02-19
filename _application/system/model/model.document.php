<?php
class model_document
{

		
	public function insert($post)
	{		
		$columns 				=		sql_get_column($this->database);
		$data					=		sql_parse_input($post, $columns);				
		sql_insert($this->database, $data);
	}
	
	public function select($user_id, $document_id)
	{
		$user_id				=	string_clean_number($user_id);
		$document_id			=	string_clean_number($document_id);		
		$rows					=	sql_select("select *, document.document_name from {$this->database} join document on document.document_id = user_document.document_id where user_document.user_id = {$user_id} AND user_document.document_id = {$document_id}");
		return $rows[0];
	}	
	
	public function select_name($document_id)
	{
		
		$document_id			=	string_clean_number($document_id);		
		$rows					=	sql_select("select document_name from document where document_id = {$document_id}");
		return $rows[0]['document_name'];
	}	
	
	
	
	public function select_by_user($user_id)
	{
		$user_id				=	string_clean_number($user_id);			
		$rows					=	sql_select("
													select * from {$this->database} 
													
														join document on  user_document.document_id = document.document_id
														left JOIN status_document ON status_document.status_document_id = user_document.user_document_approve
														
													where user_id = {$user_id}");
		
		$documents				=	sql_select("select * from document");
		
		foreach($documents as $document)
		{
			$document_by_ids[$document['document_id']]		=	$document;
		}
		
		foreach($rows as $row)
		{
			$row_by_id[$row['document_id']]		=	$row;
		}
		
		foreach($document_by_ids as $doc_id => $document)
		{			
			$row										=	$row_by_id[$doc_id];
			
			if($row)
			{
				$download								=	"/{$this->document_path}{$row['user_document_path']}";
				$data[$doc_id]							=	$row;
				$data[$doc_id]['download']				=	'<a class="link_inline_1" href="'.$download.'">Download</a>';
				$status_name							=	($row['status_document_name']) ? $row['status_document_name'] : 'Unverified';
				$data[$doc_id]['status']				=	($row['status_document_id'] == 1 || $row['status_document_id'] > 4) ? '<span class="text_table_normal good">'.$status_name.'</span>' : '<span class="text_table_normal bad">'.$status_name.'</span>';
			}
			else
			{
				$data[$doc_id]['status']				=	'<span class="text_table_normal bad">Missing</span>';
				$data[$doc_id]['download']				=	'<span class="bad">X</span>';
			}		
		}
		
		#hash_dump($data);
		
		
		return $data;
	}	
	
	
	
	
			
	public function update_user_document($user_id, $document_id, $post)
	{
		$columns 				=		sql_get_column($this->database);
		$data					=		sql_parse_input($post, $columns);		
		$user_id				=		string_clean_number($user_id);
		$document_id			=		string_clean_number($document_id);
		
		sql_query("update user_document set user_document_approve = {$data['user_document_approve']} where user_id = {$user_id} AND document_id = {$document_id}");
	}
	
	public function update($post)
	{
		$columns 				=		sql_get_column($this->database);
		$data					=		sql_parse_input($post, $columns);		
		$id						=		$data['useruser_document_id'] * 1; unset($data['user_document_id']);
		sql_update($this->database, 'user_document_id', $id, $data);
	}
	
	
	
	public function delete($user_document_id, $file_object)
	{
		$user_document_id		=	string_clean_number($user_document_id);		
		$id[]						=	$user_document_id;
		$rows						=	sql_select("select * from {$this->database} where user_document_id = {$user_document_id}");
		
		$file_object->delete($this->document_path . $rows[0]['user_document_path']);
		sql_delete($this->database, 'user_document_id', $id);		
	}
	
    public function import_file($post)
    {
        $file = $post['user_document_path'];
        $fp = fopen( "fpi_files/documents/" . $file , r );
        
           
            /*echo "<table border=\"1\">\n";
            while($csv_line = fgetcsv($fp)) 
            {
            
                echo '<tr>';
                for ($i = 0, $j = count($csv_line); $i < $j; $i++) 
                {
                    
                    echo '<td>'.$csv_line[$i].'</td>';
                    
                }
                
                echo "</tr>\n";
             }
             
             echo "</table>\n";*/
            
         while($csv_line = fgetcsv($fp)) 
         {
            for ($i = 0, $j = count($csv_line); $i < $j; $i++) 
            {
                
                print_r($csv_line[$i]) ;
            }  
         }
         //$csv    =    file_get_contents("fpi_files/documents/" . $file); 
         //$csv = $csv_line;
  
         $data   =   explode("\n", trim($csv));
         $head   =   $data[0];
         unset($data[0]);
        
         $head   =   explode(',', str_replace(array(' ', "\r"), '', $head));
        
            foreach($data as $row)
            {
                //$temp   =    explode(',', str_replace(' ', '', $row));
                $temp   =    explode(',', $row);
                $key    =   0;
                foreach($temp as $ent)
                {
                    $final[$head[$key]] =   $ent;
                    $key++;
                }
                
                $new[]  =   $final;
            }
         //hash_dump($new);
        
         fclose($fp) or die('cannot close file');   
           
       //echo "<table>\n";   //$this->document_path . 
        /*while($csv_line = fgetcsv($fp)) 
        {
            //echo '<tr>';
            for ($i = 0, $j = count($csv_line); $i < $j; $i++) 
            {
                //echo '<td>'.$csv_line[$i].'</td>';
                print_r($csv_line[$i] . '\n') ;
                
            }
            //echo "</tr>\n";
        }*/
        //echo "</table>\n";
        //fclose($fp) or die('cannot close file');   
        //hash_dump($post);
        //echo 1;
    }	
	
	
	/*
    
    $firstline = fgets ($file, 4096 );
            //Gets the number of fields, in CSV-files the names of the fields are mostly given in the first line
            $num = strlen($firstline) - strlen(str_replace(";", "", $firstline));

            //save the different fields of the firstline in an array called fields
            $fields = array();
            $fields = explode( ";", $firstline, ($num+1) );

            $line = array();
            $i = 0;

            //CSV: one line is one record and the cells/fields are seperated by ";"
            //so $dsatz is an two dimensional array saving the records like this: $dsatz[number of record][number of cell]
            while ( $line[$i] = fgets ($file, 4096) ) 
            {
                $dsatz[$i] = array();
                $dsatz[$i] = explode( ";", $line[$i], ($num+1) );

                $i++;
            }

            echo "<table>";
            echo "<tr>";
            for ( $k = 0; $k != ($num+1); $k++ ) 
            {
                echo "<td>" . $fields[$k] . "</td>";
            }
                echo "</tr>";

            foreach ($dsatz as $key => $number) 
            {
                //new table row for every record
                echo "<tr>";
                foreach ($number as $k => $content) 
                {
                //new table cell for every field of the record
                    echo "<td>" . $content . "</td>";
                }
                echo "</tr>";
            }

            echo "</table>";
             
    */
	
     
    public function sample()
    {
        $csv    =   
        'Program Type    Program Year    Priority Number    Last Name    First Name    Middle Name    Gender    School    Course    Home Phone #    Mobile Phone #    Email Address    Assessment Fee    Assessment Fee Date    Assessment Fee Time    Assessment Fee Bank
WAT    2013    07-13-022    Butiong    Jose Rafael    Alba    Male    Centro Escolar University Manila    Tourism    N/A    9175667574    rafaelbutiong@yahoo.com    5750    Jul.02.2012    18:08    VETERANS
WAT    2013    09-13-519    Angeles    Romynelle    Cuapiaco    Female    University of the East Manila    Hotel and Restaurant Management    63-022543150    9178903832    roms.angeles@yahoo.com    5750    Jun.30.2012    14:33:44    BDO
        ';
        
        $data   =   explode("\n", trim($csv));
        $head   =   $data[0];
        unset($data[0]);
        
        hash_dump($data);
        $head   =   explode(',', str_replace(array(' ', "\r"), '', $head));
        
        foreach($data as $row)
        {
            $temp   =    explode(',', str_replace(' ', '', $row));
            $key    =   0;
            foreach($temp as $ent)
            {
                $final[$head[$key]] =   $ent;
                $key++;
            }
            
            $new[]  =   $final;
        }
        hash_dump($new);
        
    }
}
?>
