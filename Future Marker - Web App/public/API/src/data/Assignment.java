package data;

import api.DB;
import java.util.ArrayList;

import java.sql.*;

public class Assignment {

    private static Assignment instance = new Assignment();
    private FinishedAssignment finishedAssignment = FinishedAssignment.getInstance();

    private int compilation_grade;
    private int style_grade;
    private int dynamic_test_grade;
    private int feature_test_grade;
    private ArrayList<DynamicTest> dynamic_tests = new ArrayList<DynamicTest>();
    private ArrayList<FeatureTest> feature_tests = new ArrayList<FeatureTest>();

    private Assignment() {

        try {
            ResultSet result = DB.SQLStmt().executeQuery("SELECT `compilation_grade`, `style_grade`, `dynamic_test_grade`, `feature_test_grade` FROM `assignments` WHERE `id` = " + finishedAssignment.getAssignment_id());
            if (result.next()) {
                this.compilation_grade = Integer.parseInt(result.getString("compilation_grade"));
                this.style_grade = Integer.parseInt(result.getString("style_grade"));
                this.dynamic_test_grade = Integer.parseInt(result.getString("dynamic_test_grade"));
                this.feature_test_grade = Integer.parseInt(result.getString("feature_test_grade"));
            }

            ResultSet result2 = DB.SQLStmt().executeQuery("SELECT * FROM `dynamic_tests` WHERE `assignment_id` = " + finishedAssignment.getAssignment_id());
            while (result2.next()) {
                getDynamic_tests().add(new DynamicTest(result2.getString("input"), result2.getString("output"), "1".equals(result2.getString("hidden"))));
            }

            ResultSet result3 = DB.SQLStmt().executeQuery("SELECT * FROM `feature_tests` WHERE `assignment_id` = " + finishedAssignment.getAssignment_id());
            while (result3.next()) {
                getFeature_tests().add(new FeatureTest(result3.getString("test_name"), result3.getString("regex"), Integer.parseInt(result3.getString("repetition"))));
            }
        } catch (SQLException exc) {
        }
    }

    public static Assignment getInstance() {
        return instance;
    }

    public int getCompilation_grade() {
        return compilation_grade;
    }

    public int getStyle_grade() {
        return style_grade;
    }

    public int getDynamic_test_grade() {
        return dynamic_test_grade;
    }

    public int getFeature_test_grade() {
        return feature_test_grade;
    }

    public ArrayList<DynamicTest> getDynamic_tests() {
        return dynamic_tests;
    }

    public ArrayList<FeatureTest> getFeature_tests() {
        return feature_tests;
    }
}
