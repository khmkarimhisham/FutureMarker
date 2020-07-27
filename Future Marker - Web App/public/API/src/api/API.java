package api;

import data.Assignment;
import data.FinishedAssignment;
import compiler.Compiler;
import dynamicTest.DynamicTest;
import featureTest.FeatureTest;
import style.Style;

public class API {

    public static boolean ready = true;

    public static void main(String[] args) {

        FinishedAssignment finishedAssignment = FinishedAssignment.getInstance();

        finishedAssignment.setUser_id(args[0]);
        finishedAssignment.setAssignment_id(args[1]);
        finishedAssignment.setAssignment_dir(args[2]);
        finishedAssignment.setAssignment_main(args[2]);

        Style.check();
        FeatureTest.check();
        Compiler.compile();
        if (ready) {
            DynamicTest.check();
            finishedAssignment.save();
        } else {
            System.out.println("false");
        }
    }
}
