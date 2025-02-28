<?php

interface Observer { // Subscriber
    public function update($message);
}

interface Subject { // Publisher
    public function addObserver(Observer $observer);
    public function removeObserver(Observer $observer);
    public function notificate();
}

class ConcreteSubject implements Subject {
    private $observers = [];
    private $message;

    public function addObserver(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function removeObserver(Observer $observer)
    {
        foreach ($this->observers as $key => $obs) {
            if ($obs === $observer) {
                unset($this->observers[$key]);
            }
        }
    }

    public function notificate()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this->message);
        }
    }

    public function setMessage($message) {
        $this->message = $message;
        $this->notificate();
    }
}

class ConcreteObserver implements Observer {
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function update($message)
    {
        echo "Observer $this->name recebeu a mensagem: $message\n";
    }
}

$subject = new ConcreteSubject();

$observer1 = new ConcreteObserver("Gabriel");
$observer2 = new ConcreteObserver("Fernando");
$observer3 = new ConcreteObserver("Alexandre");

$subject->addObserver($observer1);
$subject->addObserver($observer2);

$subject->setMessage("Chegou a primeira!");

$subject->removeObserver($observer2);

$subject->setMessage("Segunda notificação!");
