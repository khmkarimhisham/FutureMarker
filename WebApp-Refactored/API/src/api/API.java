package api;

import compiler.*;
import commentChecker.*;
import dynamicTest.DynamicTestCheck;
import featureTest.FeatureTestCheck;
import indentation.*;

public class API {

    public static void main(String[] args) {

        DoingAssignment.setStudent_ID(args[0]);
        DoingAssignment.setAssignment_ID(args[1]);
        DoingAssignment.setAssignment_dir(args[2]);

        Assignment.setAssignment();
        CodeCompiler.compile();
        CommentChecker.check();
        Indentation.check();
        DynamicTestCheck.check();
        FeatureTestCheck.check();
        DoingAssignment.sql_insert();
    
        
    }
}
