package com.gymApp.gymApplication;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class GymController {

    @GetMapping("/")
    public String showRoot(){
        return "Welcome to gym app";
    }

    @GetMapping("/home")
    public String showHome(){
        return "home.jsp";
    }
}
