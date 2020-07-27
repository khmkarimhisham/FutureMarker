package featureTest;

import data.Assignment;
import data.FinishedAssignment;
import java.io.File;
import java.io.FileNotFoundException;
import java.util.ArrayList;
import java.util.Scanner;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class FeatureTest {

    public static void check() {

        ArrayList<String> feature_test_feedback_arr = new ArrayList<String>();
        Assignment assignment = Assignment.getInstance();
        FinishedAssignment finishedAssignment = FinishedAssignment.getInstance();
        String[] children = finishedAssignment.getAssignment_files();
        //  File file = new File(finishedAssignment.getAssignment_dir());
        int i;
        float trueAnswer = 0;
        for (i = 0; i < assignment.getFeature_tests().size(); i++) {
            String regex = assignment.getFeature_tests().get(i).getRegex();
            int repetition_counter = assignment.getFeature_tests().get(i).getRepetition();
            int count = 0;

            for (String child : children) {
                File file = new File(child);
                StringBuilder fileString = new StringBuilder();

                try {
                    Scanner myReader = new Scanner(file);
                    while (myReader.hasNextLine()) {
                        fileString.append("\n").append(myReader.nextLine());
                    }
                    myReader.close();

                } catch (FileNotFoundException e) {

                }
                Pattern pattern = Pattern.compile(regex);
                Matcher matcher = pattern.matcher(fileString);

                while (matcher.find()) {
                    count++;
                }
            }

            if (count >= repetition_counter) {
                feature_test_feedback_arr.add("true");
                feature_test_feedback_arr.add("Nice work by using " + assignment.getFeature_tests().get(i).getName());
                trueAnswer++;
            } else {
                feature_test_feedback_arr.add("false");
                feature_test_feedback_arr.add("You must use " + assignment.getFeature_tests().get(i).getName() + " " + assignment.getFeature_tests().get(i).getRepetition() + " " + ((assignment.getFeature_tests().get(i).getRepetition() == 1) ? "time" : "times") + " at least");
            }
        }
        finishedAssignment.setFeature_test_feedback(String.join("#|#|#|#", feature_test_feedback_arr));
        finishedAssignment.setFeature_test_grade(Math.round((trueAnswer / i) * assignment.getFeature_test_grade()));
    }
}
