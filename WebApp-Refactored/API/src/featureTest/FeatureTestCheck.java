package featureTest;

import api.Assignment;
import api.DoingAssignment;
import java.io.File;
import java.io.FileNotFoundException;
import java.util.ArrayList;
import java.util.Scanner;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class FeatureTestCheck {

    private static ArrayList<String> feature_test_feedback_arr = new ArrayList<String>();

    public static void check() {

        File file = new File(DoingAssignment.getAssignment_dir());
        int i;
        float trueAnswer = 0;
        for (i = 0; i < Assignment.getFeature_test_array().size(); i++) {
            String regex = Assignment.getFeature_test_array().get(i).getRegex();
            int repetition_counter = Assignment.getFeature_test_array().get(i).getRepetition();
            int count = 0;

            StringBuilder fileString = new StringBuilder();
            try {
                Scanner myReader = new Scanner(file);
                while (myReader.hasNextLine()) {
                    fileString.append("\n").append(myReader.nextLine());
                }
                myReader.close();

            } catch (FileNotFoundException e) {
                e.toString();
            }
            Pattern pattern = Pattern.compile(regex);
            Matcher matcher = pattern.matcher(fileString);

            while (matcher.find()) {
                count++;
            }
            if (count >= repetition_counter) {
                feature_test_feedback_arr.add("true");
                feature_test_feedback_arr.add("Nice work by using " + Assignment.getFeature_test_array().get(i).getName());
                trueAnswer++;
            } else {
                feature_test_feedback_arr.add("false");
                feature_test_feedback_arr.add("You must use " + Assignment.getFeature_test_array().get(i).getName() + " " + Assignment.getFeature_test_array().get(i).getRepetition() + " " + ((Assignment.getFeature_test_array().get(i).getRepetition() == 1) ? "time" : "times") + " at least");
            }
        }
        DoingAssignment.setFeature_test_feedback(String.join("#|#|#|#", feature_test_feedback_arr));
        DoingAssignment.setFeature_test_grade(Math.round((trueAnswer / i) * Assignment.getFeature_test_grade()));
    }
}
