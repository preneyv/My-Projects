package com.tarot.vue;


import com.tarot.model.ArcanesMineures;
import com.tarot.model.Card;

import javax.swing.*;
import java.awt.*;

public class PanelForArcanesMineureDetail extends AbstractPanelForArcanesType {




    private final JPanel panelDomain = new JPanel(new GridLayout(1,1));
    private final JLabel domain = new JLabel();
    private final JButton iconSetDomain = new JButton();

    private final JComboBox comboBoxNumber = new JComboBox();
        private final String[] numberModel = {"Choisissez...", "As", "2", "3", "4", "5", "6", "7", "8", "9","10", "Valet", "Cavalier", "Reine", "Roi"};
        private final DefaultComboBoxModel modelNumber = new DefaultComboBoxModel(numberModel);
    private final JComboBox comboBoxDomain = new JComboBox();
        private final String[] domainModel = {"Choisissez...","Coupes", "Epées", "Batons","Deniers"};
        private final DefaultComboBoxModel modelDomain = new DefaultComboBoxModel(domainModel);


    private final GridLayout gbL = new GridLayout(3,1);

    /**
     * Constructor
     * @param c the currently card detailPanel shows
     */
    public PanelForArcanesMineureDetail(ArcanesMineures c)
    {
        super();
        initComponent();
        this.currentCard = c;
        this.name.setText(c.getNom());
        this.number.setText(c.getNumber());
        this.domain.setText(c.getDom());
        setStyleComponent();
        fillHashMap();

    }


    /**
     * init Component and add button to a listener and the correct hashmap
     */
    public void initComponent() {

        super.initComponent();
        this.setLayout(gbL);
        this.setOpaque(false);
        this.setBackground(new Color(3,3,32));
        this.panelDomain.setName("panelDomain");
        this.comboBoxDomain.setModel(this.modelDomain);
        this.comboBoxNumber.setModel(this.modelNumber);
        this.setPreferredSize(new Dimension(100,30));
        this.iconSetDomain.setIcon(new ImageIcon(getClass().getResource("/images/").getPath()+"edit.png"));
        this.panelDomain.add(this.domain);
        VueTest.mapBtnHoverAction.put(this.domain,this);
        this.domain.addMouseListener(btnAct);
        this.panelDomain.add(this.iconSetDomain);
        VueTest.mapBtnHoverAction.put(this.iconSetDomain,this);
        VueTest.mapBtnClickAction.put(this.iconSetDomain,this);
        this.iconSetDomain.addMouseListener(btnAct);
        VueTest.mapBtnHoverAction.put(this.comboBoxDomain,this);
        this.comboBoxDomain.addMouseListener(btnAct);

        this.panelDomain.setBackground(new Color(50,51,50));
        this.add(this.panelDomain);

    }

    /**
     * To set the properties the labels components turn into JtextField or JComboBox
     * a HashMap is created to link JLabel and JTextField/JComboBox that are in the same panel
     * (panel planet)
     * after a super one
     */
    public void fillHashMap()
    {
        super.fillHashMap();
        this.fieldAndHisKey.put(this.panelDomain.getName(),this.comboBoxDomain);
        this.fieldAndHisKey.put(this.panelNumber.getName(),this.comboBoxNumber);
        this.labelAndHisKey.put(this.panelDomain.getName(),this.domain);
        this.labelAndHisKey.put(this.panelNumber.getName(),this.number);
    }



    /**
     *
     * @return the new card that will replace the old one in the collection card
     */
    @Override
    public Card modifyCardAfterValidForm() {
        return new ArcanesMineures(this.number.getText(), this.currentCard.getPicture(), this.name.getText(), this.domain.getText());
    }


    /**
     * set differents style to the components after a super one
     */
    public void setStyleComponent() {

        super.setStyleComponent();
        this.domain.setForeground(Color.WHITE);
    }



    /**
     * reset the state of domain panel
     */
    public void resetStateField()
    {
        super.resetStateField();
        this.panelDomain.remove(0);
        this.panelDomain.add(this.domain,0);
        this.panelDomain.getComponent(0).setVisible(true);
        ((JButton)this.panelDomain.getComponent(1)).setIcon((new ImageIcon(getClass().getResource("/images/").getPath() + "edit.png")));

    }
}
