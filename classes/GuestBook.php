<?php
class GuestBook
{
    private $xmlFile;
    
    public function __construct($xmlFile = 'docs/guestBook.xml')
    {
        $this->xmlFile = $xmlFile;
        
        if (! file_exists($this->xmlFile)) {
            $this->initializeXml();
        }
    }
    
    private function initializeXml()
    {
        $xml = new SimpleXMLElement('<guestbook></guestbook>');
        $xml->asXML($this->xmlFile);
    }
    
    public function createEntry($name, $email, $message, $date)
    {
        $xml = simplexml_load_file($this->xmlFile);
        $entry = $xml->addChild('entry');
        $entry->addChild('name', $name);
        $entry->addChild('email', $email);
        $entry->addChild('message', $message);
        $entry->addChild('date', $date);
        $xml->asXML($this->xmlFile);
    }
    
    public function readEntries()
    {
        $entries = [];
        
        $xml = simplexml_load_file($this->xmlFile);
        foreach ($xml->entry as $entry) {
            $entries[] = [
                'name' => $entry->name,
                'email' => $entry->email,
                'message' => $entry->message
            ];
        }
        
        return $entries;
    }
    
    public function renderEntries()
    {
        $entries = $this->readEntries();
        
        if (!empty($entries)) {
            $output = '<table id="guest-book">';
            $output .= '<tr><th>Nombre</th><th>Email</th><th>Mensaje</th></tr>';
            foreach ($entries as $entry) {
                $output .= $this->renderEntry($entry);
            }
            $output .= '</table>';
        } else {
            $output = '<p id="sin-entradas">No hay entradas en el libro de visitas.</p>';
        }
        
        return $output;
    }
    
    private function renderEntry($entry)
    {
        return '<tr>' . '<td>' . $entry['name'] . '</td>' . '<td>' . $entry['email'] . '</td>' . '<td>' . $entry['message'] . '</td>' . '</tr>';
    }
}

?>